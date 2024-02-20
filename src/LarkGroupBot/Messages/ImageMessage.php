<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\LarkGroupBot\Messages;

/**
 * @method self imageKey($imageKey)
 */
class ImageMessage extends Message
{
    protected array $defined = [
        'image_key',
    ];

    protected function type(): string
    {
        return 'image';
    }
}
