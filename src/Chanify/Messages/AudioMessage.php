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

namespace Guanguans\Notify\Chanify\Messages;

/**
 * @method self audio(mixed $audio)
 */
class AudioMessage extends Message
{
    /** @var list<string> */
    protected array $defined = [
        'audio',
    ];
}
