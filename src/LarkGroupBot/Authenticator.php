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

use Guanguans\Notify\Foundation\Authenticators\AggregateAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\PayloadAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\TokenUriTemplateAuthenticator;
use GuzzleHttp\RequestOptions;

class Authenticator extends AggregateAuthenticator
{
    public function __construct(string $token, ?string $secret = null)
    {
        $authenticators = [new TokenUriTemplateAuthenticator($token)];

        if ($secret) {
            $authenticators[] = new PayloadAuthenticator(
                ['timestamp' => $timestamp = time(), 'sign' => $this->sign($secret, $timestamp)],
                RequestOptions::JSON
            );
        }

        parent::__construct(...$authenticators);
    }

    private function sign(string $secret, int $timestamp): string
    {
        return base64_encode(hash_hmac('sha256', '', sprintf("%s\n%s", $timestamp, $secret), true));
    }
}
