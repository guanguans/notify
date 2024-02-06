<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Zulip;

use Guanguans\Notify\Ntfy\BasicAuthenticator;

class Authenticator extends BasicAuthenticator
{
    public function __construct(string $botEmail, string $botApiKey)
    {
        parent::__construct($botEmail, $botApiKey);
    }
}
