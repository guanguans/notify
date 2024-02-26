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

use Guanguans\Notify\Foundation\Concerns\AsPost;
use GuzzleHttp\RequestOptions;

abstract class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;

    public function toHttpUri(): string
    {
        return 'https://oapi.dingtalk.com/robot/send';
    }

    public function toHttpOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'msgtype' => $this->type(),
                $this->type() => $this->getOptions(),
                'at' => $this->getOptions(),
            ],
        ];
    }

    abstract protected function type(): string;
}
