<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\ZohoCliq;

use Guanguans\Notify\Foundation\Authenticators\NullAuthenticator;
use Guanguans\Notify\Foundation\Caches\FileCache;
use Guanguans\Notify\Foundation\Client;
use Guanguans\Notify\Foundation\Exceptions\RequestException;
use Guanguans\Notify\ZohoCliq\Messages\AccessTokenMessage;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @see https://github.com/w7corp/easywechat/blob/6.x/src/OfficialAccount/AccessToken.php
 * @see https://github.com/w7corp/easywechat/blob/6.x/src/OpenPlatform/ComponentAccessToken.php
 * @see https://github.com/w7corp/easywechat/blob/6.x/src/OpenWork/AuthorizerAccessToken.php
 * @see https://github.com/w7corp/easywechat/blob/6.x/src/Work/AccessToken.php
 *
 * ```
 * curl --location 'https://accounts.zoho.com/oauth/v2/token' \
 * --form 'client_id="1000.TTFROV098VVFG8NB686LR98TCDR"' \
 * --form 'client_secret="ffddfbd23c86a677e024003b4b8b8b7f2371ac6"' \
 * --form 'grant_type="client_credentials"' \
 * --form 'scope="ZohoCliq.Webhooks.CREATE,ZohoCliq.Channels.READ,ZohoCliq.Bots.READ,ZohoCliq.Chats.READ,ZohoCliq.Users.READ"'.
 *
 * curl --location 'https://cliq.zoho.com/api/v2/channels' \
 * --header 'Authorization: Zoho-oauthtoken 1000.80e9143983dcc190427cad7e8f029e25.cdc1c1043e5e7f0555fc14fc7faf3' \.
 *
 * curl --location 'https://cliq.zoho.com/api/v2/chats' \
 * --header 'Authorization: Zoho-oauthtoken 1000.80e9143983dcc190427cad7e8f029e25.cdc1c1043e5e7f0555fc14fc7faf3' \
 *
 * curl --location 'https://cliq.zoho.com/api/v2/users?limit=5' \
 * --header 'Authorization: Zoho-oauthtoken 1000.80e9143983dcc190427cad7e8f029e25.cdc1c1043e5e7f0555fc14fc7faf3' \
 * ```
 */
class Authenticator extends NullAuthenticator implements \Stringable
{
    private readonly string $cacheKey;

    /** @var null|callable */
    private $retryDelay;
    private readonly Client $client;

    /**
     * @param null|key-of<\Guanguans\Notify\ZohoCliq\DataCenter::BASE_URI_MAP> $dataCenter
     *
     * @noinspection PhpDocSignatureInspection
     */
    public function __construct(
        private readonly string $clientId,
        #[\SensitiveParameter]
        private readonly string $clientSecret,
        private readonly DataCenter $dataCenter = DataCenter::US,
        private readonly CacheInterface $cache = new FileCache,
        ?string $cacheKey = null,
        ?callable $retryDelay = null,
        ?Client $client = null,
    ) {
        $this->cacheKey = $cacheKey ?? "zoho_cliq.access_token.{$this->dataCenter->value}.$clientId.$clientSecret";
        $this->retryDelay = $retryDelay;
        $this->client = ($client ?? new Client)->baseUri($this->dataCenter->toOauthBaseUri());
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function __toString(): string
    {
        return $this->getToken();
    }

    public function applyToMiddleware(callable $handler): callable
    {
        return array_reduce(
            [
                $this->baseUriMiddleware(),
                $this->authMiddleware(),
                $this->retryMiddleware(),
            ],
            static fn (callable $handler, callable $next): callable => $next($handler),
            $handler,
        );
    }

    /**
     * @see \GuzzleHttp\Client::buildUri()
     * @see \GuzzleHttp\Client::requestAsync()
     * @see \GuzzleHttp\Client::sendAsync()
     */
    private function baseUriMiddleware(): callable
    {
        return Middleware::mapRequest(
            function (RequestInterface $request): RequestInterface {
                $parsedBaseUri = parse_url($this->dataCenter->toBaseUri());

                return $request->withUri(
                    $request->getUri()->withScheme($parsedBaseUri['scheme'])->withHost($parsedBaseUri['host']),
                    $request->hasHeader('Host')
                );
            },
        );
    }

    private function authMiddleware(): callable
    {
        return Middleware::mapRequest(
            fn (RequestInterface $request): RequestInterface => $request->withHeader('Authorization', "Bearer $this"),
        );
    }

    /**
     * @see \GuzzleHttp\RetryMiddleware::exponentialDelay()
     * @see \GuzzleHttp\RetryMiddleware::onFulfilled()
     * @see \GuzzleHttp\RetryMiddleware::onRejected()
     */
    private function retryMiddleware(): callable
    {
        return Middleware::retry(
            function (int $retries, RequestInterface $request, ?ResponseInterface $response = null): bool {
                if (1 <= $retries) {
                    return false;
                }

                if (401 === $response?->getStatusCode()) {
                    // $request = &$request->withHeader('Authorization', "Bearer {$this->refreshToken()}");
                    $this->cache->delete($this->cacheKey);

                    return true;
                }

                return false;
            },
            $this->retryDelay
        );
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     */
    private function getToken(): string
    {
        if (($token = $this->cache->get($this->cacheKey)) && \is_string($token)) {
            return $token;
        }

        return $this->refreshToken();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \ReflectionException
     *
     * ```200
     * {
     *     "access_token": "1000.86e0701b6f279bfad7b6a05352dc304d.3106ea5d20401799c010212da3da1",
     *     "scope": "ZohoCliq.Webhooks.CREATE",
     *     "api_domain": "https://www.zohoapis.com",
     *     "token_type": "Bearer",
     *     "expires_in": 3600
     * }
     * ```
     *
     * ```200
     * {"error":"invalid_client_secret"}
     * ```
     *
     * ```400
     * {"error_description":"You have made too many requests continuously. Please try again after some time.","error":"Access Denied","status":"failure"}
     * {"error_description":"您已连续提出过多请求，请稍后再试。","error":"拒绝访问","status":"failure"}
     * ```
     */
    private function refreshToken(): string
    {
        $response = $this->client->send(AccessTokenMessage::make([
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]))->throw();

        if (!$token = $response->json('access_token')) {
            throw RequestException::createFromResponse($response);
        }

        $this->cache->set($this->cacheKey, $token, abs((int) $response->json('expires_in') - 100));

        return $token;
    }
}
