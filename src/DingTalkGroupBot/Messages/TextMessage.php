<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\DingTalkGroupBot\Messages;

/**
 * @method self content($content)
 * @method self atMobiles($atMobiles)
 * @method self atDingtalkIds($atDingtalkIds)
 * @method self isAtAll($isAtAll)
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
        'atMobiles' => ['int', 'string', 'array'],
        'atDingtalkIds' => ['int', 'string', 'array'],
        'isAtAll' => 'bool',
    ];

    protected function type(): string
    {
        return 'text';
    }
}
