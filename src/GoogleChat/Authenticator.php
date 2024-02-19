<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\GoogleChat;

use Guanguans\Notify\Foundation\Authenticators\AggregateAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\PayloadAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\UriTemplateAuthenticator;
use GuzzleHttp\RequestOptions;

class Authenticator extends AggregateAuthenticator
{
    public function __construct(string $spaceId, string $key, string $token, ?string $threadKey = null)
    {
        $payload = ['key' => $key, 'token' => $token];
        $threadKey and $payload['threadKey'] = $threadKey;

        $authenticators = [
            new UriTemplateAuthenticator(['spaceId' => $spaceId]),
            new PayloadAuthenticator($payload, RequestOptions::QUERY),
        ];

        parent::__construct(...$authenticators);
    }
}
