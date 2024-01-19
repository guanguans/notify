<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Mailer\Messages;

use Guanguans\Notify\Foundation\Traits\HasOptions;
use Symfony\Component\Mime\Email;

class Message extends Email implements \Guanguans\Notify\Foundation\Contracts\Message
{
    use HasOptions;
}
