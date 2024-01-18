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

class PostMessage extends HttpMessage
{
    protected string $type = 'post';

    protected array $defined = [
        'post',
    ];

    protected array $allowedTypes = [
        'post' => 'array',
    ];

    /**
     * PostMessage constructor.
     */
    public function __construct(array $post)
    {
        parent::__construct(['post' => $post]);
    }

    /**
     * @noinspection JsonEncodingApiUsageInspection
     */
    public function __toString(): string
    {
        return json_encode([
            'msg_type' => $this->type,
            'content' => $this->options,
        ]);
    }

    public function httpMethod(): string
    {
        return 'POST';
    }

    public function httpUri(): string
    {
        return 'https://open.feishu.cn/open-apis/bot/v2/hook/token';
    }
}
