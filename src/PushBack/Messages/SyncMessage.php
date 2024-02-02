<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\PushBack\Messages;

/**
 * @method \Guanguans\Notify\PushBack\Messages\SyncMessage id($id)
 * @method \Guanguans\Notify\PushBack\Messages\SyncMessage title($title)
 * @method \Guanguans\Notify\PushBack\Messages\SyncMessage body($body)
 * @method \Guanguans\Notify\PushBack\Messages\SyncMessage action1($action1)
 * @method \Guanguans\Notify\PushBack\Messages\SyncMessage action2($action2)
 * @method \Guanguans\Notify\PushBack\Messages\SyncMessage reply($reply)
 */
class SyncMessage extends Message
{
    public function toHttpUri(): string
    {
        return 'https://api.pushback.io/v1/send_sync';
    }
}
