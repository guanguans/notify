<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\PushDeer\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method self text($text)
 * @method self desp($desp)
 * @method self type($type)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $defined = [
        'text',
        'desp',
        'type',
    ];

    protected array $allowedValues = [
        // 'type' => ['text', 'markdown', 'image'],
    ];

    public function toHttpUri(): string
    {
        return 'message/push?pushkey={token}';
    }
}
