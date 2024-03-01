<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Push;

use Guanguans\Notify\Foundation\Authenticators\AggregateAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\PayloadAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\TokenUriTemplateAuthenticator;
use GuzzleHttp\RequestOptions;

class Authenticator extends AggregateAuthenticator
{
    public function __construct(string $apiKey)
    {
        parent::__construct(
            new TokenUriTemplateAuthenticator($apiKey),
            new PayloadAuthenticator(['X-Api-Key' => $apiKey], RequestOptions::HEADERS)
        );
    }
}
