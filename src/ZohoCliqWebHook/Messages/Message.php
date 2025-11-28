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

namespace Guanguans\Notify\ZohoCliqWebHook\Messages;

use Guanguans\Notify\Foundation\Concerns\AsNullUri;

/**
 * @method self bot(array $bot)
 * @method self buttons(array $buttons)
 * @method self card(array $card)
 * @method self postInParent(mixed $postInParent)
 * @method self slides(array $slides)
 * @method self styles(array $styles)
 * @method self text(mixed $text)
 * @method self threadMessageId(mixed $threadMessageId)
 * @method self threadTitle(mixed $threadTitle)
 */
class Message extends \Guanguans\Notify\ZohoCliq\Messages\Message
{
    use AsNullUri;
}
