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

namespace Guanguans\Notify\DingTalk\Messages;

/**
 * @method self atDingtalkIds(array $atDingtalkIds)
 * @method self atMobiles(array $atMobiles)
 * @method self isAtAll(bool $isAtAll)
 * @method self text(mixed $text)
 * @method self title(mixed $title)
 */
class MarkdownMessage extends Message
{
    protected array $defined = [
        'title',
        'text',
        'atMobiles',
        'atDingtalkIds',
        'isAtAll',
    ];
    protected array $allowedTypes = [
        'atMobiles' => 'array',
        'atDingtalkIds' => 'array',
        'isAtAll' => 'bool',
    ];

    protected function type(): string
    {
        return 'markdown';
    }
}
