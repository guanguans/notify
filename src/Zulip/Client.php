<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Zulip;

use Guanguans\Notify\Foundation\Contracts\Authenticator;

/**
 * @see https://chat.zulip.org/accounts/login
 * @see https://zulip.com/api/send-message
 */
class Client extends \Guanguans\Notify\Foundation\Client
{
    public function __construct(Authenticator $authenticator)
    {
        parent::__construct($authenticator);
        $this->baseUri('https://chat.zulip.org/');
    }
}
