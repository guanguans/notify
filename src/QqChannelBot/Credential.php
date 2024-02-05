<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\QqChannelBot;

use Guanguans\Notify\Foundation\Credentials\TokenAuthCredential;

class Credential extends TokenAuthCredential
{
    public function __construct(string $appid, string $token)
    {
        parent::__construct("$appid.$token", 'Bot');
    }
}
