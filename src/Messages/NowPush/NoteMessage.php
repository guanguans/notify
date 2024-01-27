<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\NowPush;

use Guanguans\Notify\Messages\Message;

class NoteMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'message_type',
        'note',
        'device_type',
        'url',
    ];

    /**
     * @var array<string>
     */
    protected array $options = [
        'device_type' => 'api',
    ];

    /**
     * @var array<string>
     */
    protected array $defaults = [
        'message_type' => 'nowpush_note',
    ];

    public function __construct(string $note, string $deviceType = 'api')
    {
        parent::__construct([
            'note' => $note,
            'device_type' => $deviceType,
        ]);
    }
}
