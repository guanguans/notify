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

use Guanguans\Notify\Foundation\Method;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Token
{
    public function __construct(
        private string $clientId,
        private string $clientSecret
    ) {}

    public function generateToken(): string
    {
        $response = (new Client)->request(
            Method::POST,
            'https://accounts.zoho.com/oauth/v2/token',
            [
                RequestOptions::FORM_PARAMS => [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'grant_type' => 'client_credentials',
                    'scope' => 'ZohoCliq.Webhooks.CREATE',
                ],
            ]
        );

        $body = (string) $response->getBody();
        $json = json_decode($body ?: '[]', true, 512, \JSON_THROW_ON_ERROR);

        return $json['access_token'];
    }
}
