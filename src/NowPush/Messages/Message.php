<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\NowPush\Messages;

use Guanguans\Notify\Foundation\AbstractMessage;

/**
 * @method self deviceType(mixed $deviceType)
 * @method self messageType(mixed $messageType)
 * @method self note(mixed $note)
 * @method self url(mixed $url)
 */
class Message extends AbstractMessage
{
    /** @var list<string> */
    protected array $defined = [
        'message_type',
        'note',
        'device_type',
        'url',
    ];

    /** @var array<string, mixed> */
    protected array $allowedValues = [
        // 'message_type' => ['nowpush_note', 'nowpush_img', 'nowpush_link'],
        'device_type' => 'api',
    ];

    /** @var array<string, mixed> */
    protected array $options = [
        'device_type' => 'api',
    ];

    public function toHttpUri(): string
    {
        return 'v3/sendMessage';
    }
}
