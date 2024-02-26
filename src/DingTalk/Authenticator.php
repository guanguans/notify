<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\DingTalk;

use Guanguans\Notify\Foundation\Authenticators\PayloadAuthenticator;
use GuzzleHttp\RequestOptions;

class Authenticator extends PayloadAuthenticator
{
    public function __construct(string $token, ?string $secret = null)
    {
        $payload = ['access_token' => $token];
        if ($secret) {
            [$microseconds, $seconds] = explode(' ', microtime());
            $payload['timestamp'] = $timestamp = $seconds.sprintf('%.3f', $microseconds) * 1000;
            $payload['sign'] = $this->sign($secret, $timestamp);
        }

        parent::__construct($payload, RequestOptions::QUERY);
    }

    private function sign(string $secret, string $timestamp): string
    {
        return urlencode(base64_encode(hash_hmac(
            'sha256',
            "$timestamp\n$secret",
            $secret,
            true
        )));
    }
}
