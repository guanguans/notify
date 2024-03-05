<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Chanify\Messages;

use Guanguans\Notify\Foundation\Concerns\AsMultipart;

class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsMultipart;

    public function toHttpUri(): string
    {
        return 'v1/sender/{token}';
    }
}
