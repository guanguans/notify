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
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\MarkdownMessage title($title)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\MarkdownMessage text($text)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\MarkdownMessage atMobiles($atMobiles)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\MarkdownMessage atDingtalkIds($atDingtalkIds)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\MarkdownMessage isAtAll($isAtAll)
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
