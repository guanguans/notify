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

use Guanguans\Notify\Foundation\Concerns\AsPost;
use GuzzleHttp\RequestOptions;

abstract class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;

    public function toHttpUri(): string
    {
        return 'https://open.feishu.cn/open-apis/bot/v2/hook/{token}';
    }

    public function toHttpOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'msg_type' => $this->type(),
                'content' => $this->getOptions(),
            ],
        ];
    }

    abstract protected function type(): string;
}
