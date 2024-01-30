<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\LarkGroupBot;

use Guanguans\Notify\Foundation\Credentials\TokenUriTemplateCredential;
use GuzzleHttp\RequestOptions;

class Credential extends TokenUriTemplateCredential
{
    private ?string $secret;

    public function __construct(string $token, ?string $secret = null)
    {
        parent::__construct($token);
        $this->secret = $secret;
    }

    public function applyToOptions(array $options): array
    {
        if ($this->secret) {
            $options[RequestOptions::JSON]['timestamp'] = $timestamp = time();
            $options[RequestOptions::JSON]['sign'] = $this->sign($this->secret, $timestamp);
        }

        return $options;
    }

    private function sign(string $secret, int $timestamp): string
    {
        return base64_encode(hash_hmac('sha256', '', sprintf("%s\n%s", $timestamp, $secret), true));
    }
}
