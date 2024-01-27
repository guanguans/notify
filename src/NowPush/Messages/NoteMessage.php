<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\NowPush\Messages;

/**
 * @method \Guanguans\Notify\NowPush\Messages\NoteMessage messageType($messageType)
 * @method \Guanguans\Notify\NowPush\Messages\NoteMessage note($note)
 * @method \Guanguans\Notify\NowPush\Messages\NoteMessage deviceType($deviceType)
 * @method \Guanguans\Notify\NowPush\Messages\NoteMessage url($url)
 */
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
