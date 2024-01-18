<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\LarkGroupBot\Messages;

use Guanguans\Notify\Foundation\HttpMessage;

class TextMessage extends HttpMessage
{
    protected array $defined = [
        'text',
    ];

    public function __construct(string $text)
    {
        parent::__construct(['text' => $text]);
    }

    public function toPayload(): array
    {
        return [
            'msg_type' => 'text',
            'content' => parent::toPayload(),
        ];
    }

    public function httpMethod(): string
    {
        return 'POST';
    }

    public function httpUri(): string
    {
        return 'https://open.feishu.cn/open-apis/bot/v2/hook/<access-token>';
    }

    public function httpOptions(): array
    {
        return [
            'json' => $this->toPayload(),
        ];
    }
}
