<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\PushBack;

use Guanguans\Notify\Ntfy\BasicAuthCredential;

class Credential extends BasicAuthCredential
{
    public function __construct(string $username)
    {
        parent::__construct($username, null);
    }
}
