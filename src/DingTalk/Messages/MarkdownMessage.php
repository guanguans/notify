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
 * @method self atDingtalkIds(array $atDingtalkIds)
 * @method self atMobiles(array $atMobiles)
 * @method self isAtAll(bool $isAtAll)
 * @method self text(mixed $text)
 * @method self title(mixed $title)
 */
class MarkdownMessage extends Message
{
    /** @var list<string> */
    protected array $defined = [
        'title',
        'text',
        'atMobiles',
        'atDingtalkIds',
        'isAtAll',
    ];

    /** @var array<string, list<string>|string> */
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
