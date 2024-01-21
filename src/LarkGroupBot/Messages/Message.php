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

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\LarkGroupBot\Credential;

abstract class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;
    use AsJson;

    abstract public function type(): string;

    public function toPayload(): array
    {
        return [
            'msg_type' => $this->type(),
            'content' => $this->options,
        ];
    }

    public function httpUri(): string
    {
        return sprintf('https://open.feishu.cn/open-apis/bot/v2/hook/%s', Credential::ACCESS_TOKEN_PLACEHOLDER);
    }
}
