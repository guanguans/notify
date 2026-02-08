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
 * @method self content(mixed $content)
 * @method self isAtAll(bool $isAtAll)
 */
class TextMessage extends AbstractMessage
{
    /** @var list<string> */
    protected array $defined = [
        'content',
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
        return 'text';
    }
}
