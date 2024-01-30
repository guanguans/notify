<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\DingTalkGroupBot;

use Guanguans\Notify\Foundation\Credentials\AggregateCredential;
use Guanguans\Notify\Foundation\Credentials\QueryCredential;

class Credential extends AggregateCredential
{
    public function __construct(string $token, ?string $secret = null)
    {
        $credentials = [new QueryCredential('access_token', $token)];

        if ($secret) {
            [$microseconds, $seconds] = explode(' ', microtime());

            $credentials[] = new QueryCredential('timestamp', $timestamp = $seconds.sprintf('%.3f', $microseconds) * 1000);
            $credentials[] = new QueryCredential('sign', $this->sign($secret, $timestamp));
        }

        parent::__construct(...$credentials);
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
