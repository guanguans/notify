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
 * @method self title($title)
 * @method self text($text)
 * @method self atMobiles($atMobiles)
 * @method self atDingtalkIds($atDingtalkIds)
 * @method self isAtAll($isAtAll)
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
        'atMobiles' => ['int', 'string', 'array'],
        'atDingtalkIds' => ['int', 'string', 'array'],
        'isAtAll' => 'bool',
    ];

    protected function type(): string
    {
        return 'markdown';
    }
}
