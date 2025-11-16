<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
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
    private CacheInterface $cache;
    private string $cacheKey;
    private Client $client;

    public function __construct(
        private string $clientId,
        #[\SensitiveParameter]
        private string $clientSecret,
        ?CacheInterface $cache = null,
        ?string $cacheKey = null,
        ?Client $client = null,
    ) {
        $this->cache = $cache ?? new FileCache;
        $this->cacheKey = $cacheKey ?? "zoho_cliq.access_token.$clientId.$clientSecret";
        $this->client = $client ?? new Client;
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
                [$this, 'dataCenter'],
                [$this, 'retry'],
                [$this, 'authenticate'],
            ],
            static fn (callable $handler, callable $next): callable => $next($handler),
            $handler,
        );
    }

    /**
     * @todo
     */
    private function dataCenter(callable $handler): callable
    {
        return $handler;
    }

    private function authenticate(callable $handler): callable
    {
        return Middleware::mapRequest(
            fn (RequestInterface $request): RequestInterface => $request->withHeader('Authorization', "Bearer $this"),
        )($handler);
    }

    /**
     * @see \GuzzleHttp\RetryMiddleware::onFulfilled()
     * @see \GuzzleHttp\RetryMiddleware::onRejected()
     */
    private function retry(callable $handler): callable
    {
        return Middleware::retry(
            function (int $retries, RequestInterface &$request, ?ResponseInterface $response = null): bool {
                if (1 <= $retries) {
                    return false;
                }

                if (401 === $response?->getStatusCode()) {
                    $request = $request->withHeader('Authorization', "Bearer {$this->refreshToken()}");

                    return true;
                }

                return false;
            }
        )($handler);
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
     * ```json
     * {
     *     "access_token": "1000.86e0701b6f279bfad7b6a05352dc304d.3106ea5d20401799c010212da3da1",
     *     "scope": "ZohoCliq.Webhooks.CREATE",
     *     "api_domain": "https://www.zohoapis.com",
     *     "token_type": "Bearer",
     *     "expires_in": 3600
     * }
     * ```
     */
    private function refreshToken(): string
    {
        $response = $this->client->send(AccessTokenMessage::make([
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]));

        if (!$token = $response->json('access_token')) {
            throw RequestException::create($response->request(), $response);
        }

        $this->cache->set($this->cacheKey, $token, abs((int) $response->json('expires_in') - 100));

        return $token;
    }
}
