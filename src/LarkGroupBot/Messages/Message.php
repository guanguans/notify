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
use Guanguans\Notify\LarkGroupBot\Credential;
use GuzzleHttp\RequestOptions;

abstract class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;

    abstract protected function type(): string;

    public function httpUri(): string
    {
        return sprintf('https://open.feishu.cn/open-apis/bot/v2/hook/%s', Credential::ACCESS_TOKEN_PLACEHOLDER);
    }

    public function toHttpOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'msg_type' => $this->type(),
                'content' => $this->options,
            ],
        ];
    }
}
