<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\QQ;

use Guanguans\Notify\Foundation\Authenticators\BearerAuthenticator;

class Authenticator extends BearerAuthenticator
{
    public function __construct(string $appid, string $token)
    {
        parent::__construct("$appid.$token", 'Bot');
    }
}
