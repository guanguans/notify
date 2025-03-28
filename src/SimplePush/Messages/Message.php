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

namespace Guanguans\Notify\SimplePush\Messages;

use Guanguans\Notify\Foundation\Concerns\AsNullUri;

/**
 * @method self actions(array $actions)
 * @method self attachments(array $attachments)
 * @method self event(mixed $event)
 * @method self msg(mixed $msg)
 * @method self title(mixed $title)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsNullUri;
    protected array $defined = [
        // 'key',
        'msg',
        'title',
        'event',
        'actions',
        'attachments',
    ];
    protected array $allowedTypes = [
        'actions' => 'array',
        'attachments' => 'array',
    ];
}
