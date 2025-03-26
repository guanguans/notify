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

namespace Guanguans\Notify\XiZhi\Messages;

/**
 * @method self content(mixed $content)
 * @method self date(mixed $date)
 * @method self time(mixed $time)
 * @method self title(mixed $title)
 * @method self type(mixed $type)
 */
class SingleMessage extends Message
{
    public function toHttpUri(): string
    {
        return '{token}.send';
    }
}
