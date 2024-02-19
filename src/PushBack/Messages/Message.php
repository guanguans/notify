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

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method \Guanguans\Notify\PushBack\Messages\Message id($id)
 * @method \Guanguans\Notify\PushBack\Messages\Message title($title)
 * @method \Guanguans\Notify\PushBack\Messages\Message body($body)
 * @method \Guanguans\Notify\PushBack\Messages\Message action1($action1)
 * @method \Guanguans\Notify\PushBack\Messages\Message action2($action2)
 * @method \Guanguans\Notify\PushBack\Messages\Message reply($reply)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $defined = [
        'id',
        'title',
        'body',
        'action1',
        'action2',
        'reply',
    ];

    protected array $required = [
        'id',
        'title',
    ];

    public function toHttpUri(): string
    {
        return 'https://api.pushback.io/v1/send';
    }
}
