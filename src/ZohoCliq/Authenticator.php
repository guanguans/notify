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
use Guanguans\Notify\Foundation\Concerns\AsFormParams;
use Guanguans\Notify\Foundation\Exceptions\RequestException;
use Guanguans\Notify\Foundation\Message;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\CacheInterface;

/**
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
 * ```.
 */
class Authenticator extends NullAuthenticator
{
    private static ?string $accessToken;

    public function __construct(
        private string $clientId,
        private string $clientSecret,
        private ?CacheInterface $cache = null,
    ) {}

    public function __invoke(callable $handler): callable
    {
        return Middleware::mapRequest(
            fn (RequestInterface $request): RequestInterface => $request->withHeader('Authorization', "Bearer {$this->getAccessToken()}"),
        )($handler);
    }

    public function retry(callable $handler): callable
    {
        return Middleware::retry(function (int $retries, RequestInterface &$request, ?ResponseInterface $response = null) {
            if (1 <= $retries) {
                return false;
            }

            /** @var \Guanguans\Notify\Foundation\Response $response */
            if ($response?->unauthorized()) {
                $request = $request->withHeader('Authorization', "Bearer {$this->refreshAccessToken()}");

                return true;
            }

            return false;
        })($handler);
    }

    public static function flushAccessToken(): void
    {
        self::$accessToken = null;
    }

    private function refreshAccessToken(): string
    {
        self::flushAccessToken();

        return $this->getAccessToken();
    }

    /**
     * Temporary memory cache.
     *
     * @todo psr cache
     * @todo retry on authentication failure
     * @todo data center
     */
    private function getAccessToken(): string
    {
        return self::$accessToken ??= $this->fetchAccessToken();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    private function fetchAccessToken(): string
    {
        $response = (new \Guanguans\Notify\Foundation\Client)
            ->send(
                new class([
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'grant_type' => 'client_credentials',
                    'scope' => 'ZohoCliq.Webhooks.CREATE',
                ]) extends Message {
                    use AsFormParams;
                    protected array $defined = [
                        'client_id',
                        'client_secret',
                        'grant_type',
                        'scope',
                    ];

                    public function toHttpUri(): string
                    {
                        return 'https://accounts.zoho.com/oauth/v2/token';
                    }
                }
            );

        if ($response->json('error')) {
            throw RequestException::create($response->request(), $response);
        }

        return $response->json('access_token');
    }
}
