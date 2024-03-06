<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Lark\Messages;

abstract class Message extends \Guanguans\Notify\Foundation\Message
{
    public function toHttpUri(): string
    {
        return 'open-apis/bot/v2/hook/{token}';
    }

    protected function toPayload(): array
    {
        return [
            'msg_type' => $this->type(),
            'content' => parent::toPayload(),
        ];
    }

    abstract protected function type(): string;
}
