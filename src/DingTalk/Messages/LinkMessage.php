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

namespace Guanguans\Notify\DingTalk\Messages;

/**
 * @method self messageUrl(mixed $messageUrl)
 * @method self picUrl(mixed $picUrl)
 * @method self text(mixed $text)
 * @method self title(mixed $title)
 */
class LinkMessage extends Message
{
    protected array $defined = [
        'title',
        'text',
        'messageUrl',
        'picUrl',
    ];

    protected function type(): string
    {
        return 'link';
    }
}
