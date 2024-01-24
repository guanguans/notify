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

class QueryCredential extends ApiKeyCredential
{
    public function __construct(string $name, string $value)
    {
        parent::__construct($name, $value, RequestOptions::QUERY);
    }
}
