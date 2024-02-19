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

use Guanguans\Notify\Foundation\Contracts\Authenticator;

/**
 * @see https://chat.zulip.org/accounts/login
 * @see https://zulip.com/api/send-message
 */
class Client extends \Guanguans\Notify\Foundation\Client
{
    public function __construct(?Authenticator $authenticator = null)
    {
        parent::__construct($authenticator);
        $this->baseUri('https://chat.zulip.org/');
    }
}
