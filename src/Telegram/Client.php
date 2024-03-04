<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Telegram;

use Guanguans\Notify\Foundation\Contracts\Authenticator;

/**
 * @see https://telegram.me/botfather
 * @see https://core.telegram.org/bots/api#getupdates
 * @see https://api.telegram.org/botxxx:yyy/getUpdates
 * @see https://core.telegram.org/bots/api#sendmessage
 * @see https://api.telegram.org/botxxx:yyy/sendMessage?chat_id=xx&text=text
 */
class Client extends \Guanguans\Notify\Foundation\Client
{
    public function __construct(?Authenticator $authenticator = null)
    {
        parent::__construct($authenticator);
        $this->baseUri('https://api.telegram.org/');
    }
}
