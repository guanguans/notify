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
use GuzzleHttp\RequestOptions;

abstract class Message extends \Guanguans\Notify\Foundation\Message
{
    public function toHttpUri(): string
    {
        return 'https://oapi.dingtalk.com/robot/send';
    }

    public function toHttpOptions(): array
    {
        $options = $this->getOptions();

        return [
            RequestOptions::JSON => [
                'msgtype' => $this->type(),
                $this->type() => Arr::except($options, $atKeys = ['atMobiles', 'atDingtalkIds', 'isAtAll']),
                'at' => Arr::only($options, $atKeys),
            ],
        ];
    }

    abstract protected function type(): string;
}
