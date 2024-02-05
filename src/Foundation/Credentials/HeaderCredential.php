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

class HeaderCredential extends KeyValueCredential
{
    public function __construct(string $value, string $key = 'Authorization')
    {
        parent::__construct($key, $value);
    }
}
