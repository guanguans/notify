<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Pushback\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method self id($id)
 * @method self title($title)
 * @method self body($body)
 * @method self action1($action1)
 * @method self action2($action2)
 * @method self reply($reply)
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
