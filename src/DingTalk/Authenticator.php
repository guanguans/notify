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

use Guanguans\Notify\Foundation\Authenticators\OptionsAuthenticator;
use GuzzleHttp\RequestOptions;

class Authenticator extends OptionsAuthenticator
{
    public function __construct(string $token, ?string $secret = null)
    {
        $query = ['access_token' => $token];
        if ($secret) {
            [$microseconds, $seconds] = explode(' ', microtime());
            $query += [
                'timestamp' => $timestamp = $seconds.sprintf('%.3f', $microseconds) * 1000,
                'sign' => $this->sign($secret, $timestamp),
            ];
        }

        parent::__construct([RequestOptions::QUERY => $query]);
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
