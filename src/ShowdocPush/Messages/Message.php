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

namespace Guanguans\Notify\ShowdocPush\Messages;

use Guanguans\Notify\Foundation\AbstractMessage;

/**
 * @method self content(mixed $content)
 * @method self title(mixed $title)
 */
class Message extends AbstractMessage
{
    /** @var list<string> */
    protected array $defined = [
        'title',
        'content',
    ];

    public function toHttpUri(): string
    {
        return 'server/api/push/{token}';
    }
}
