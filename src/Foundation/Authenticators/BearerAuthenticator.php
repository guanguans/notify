<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Authenticators;

use GuzzleHttp\RequestOptions;

class BearerAuthenticator extends PayloadAuthenticator
{
    public function __construct(string $token, ?string $bearer = 'Bearer')
    {
        parent::__construct(['Authorization' => ltrim("$bearer $token")], RequestOptions::HEADERS);
    }
}
