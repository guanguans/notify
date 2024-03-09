<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
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
 * @method self content($content)
 * @method self isAtAll(bool $isAtAll)
 */
class TextMessage extends Message
{
    protected array $defined = [
        'content',
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
        return 'text';
    }
}
