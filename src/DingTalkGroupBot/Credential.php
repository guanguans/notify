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

use Guanguans\Notify\Foundation\Credentials\NullCredential;

class Credential extends NullCredential
{
    private string $token;
    private ?string $secret;

    public function __construct(string $token, string $secret = null)
    {
        $this->secret = $secret;
        $this->token = $token;
    }

    public function applyToOptions(array $options): array
    {
        $options['query']['access_token'] = $this->token;

        if ($this->secret) {
            [$microseconds, $seconds] = explode(' ', microtime());
            $options['query']['timestamp'] = $timestamp = sprintf('%d%d', $seconds, sprintf('%.3f', $microseconds) * 1000);
            $options['query']['sign'] = $this->sign($this->secret, $timestamp);
        }

        return $options;
    }

    protected function sign(string $secret, string $timestamp): string
    {
        return urlencode(base64_encode(hash_hmac(
            'sha256',
            "$timestamp\n$secret",
            $secret,
            true
        )));
    }
}
