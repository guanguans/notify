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
 * @method self btnOrientation(mixed $btnOrientation)
 * @method self singleTitle(mixed $singleTitle)
 * @method self singleURL(mixed $singleURL)
 * @method self text(mixed $text)
 * @method self title(mixed $title)
 */
class SingleActionCardMessage extends AbstractMessage
{
    /** @var list<string> */
    protected array $defined = [
        'title',
        'text',
        'singleTitle',
        'singleURL',
        'btnOrientation',
    ];

    protected function type(): string
    {
        return 'actionCard';
    }
}
