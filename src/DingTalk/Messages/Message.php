<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\DingTalk\Messages;

use Guanguans\Notify\Foundation\Support\Arr;

abstract class Message extends \Guanguans\Notify\Foundation\Message
{
    public function toHttpUri(): string
    {
        return 'robot/send';
    }

    protected function toPayload(): array
    {
        $payload = parent::toPayload();

        return [
            'msgtype' => $this->type(),
            $this->type() => Arr::except($payload, $atKeys = ['atMobiles', 'atDingtalkIds', 'isAtAll']),
            'at' => Arr::only($payload, $atKeys),
        ];
    }

    abstract protected function type(): string;
}
