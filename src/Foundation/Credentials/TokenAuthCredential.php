<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Credentials;

use GuzzleHttp\RequestOptions;

class TokenAuthCredential extends PayloadCredential
{
    public function __construct(string $token, ?string $type = 'Bearer')
    {
        parent::__construct(['Authorization' => trim("$type $token")], RequestOptions::HEADERS);
    }
}
