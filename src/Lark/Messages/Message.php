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

use Guanguans\Notify\Foundation\Support\Arr;
use GuzzleHttp\RequestOptions;

abstract class Message extends \Guanguans\Notify\Foundation\Message
{
    public function toHttpUri(): string
    {
        return 'open-apis/bot/v2/hook/{token}';
    }

    public function toHttpOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'msg_type' => $this->type(),
                'content' => Arr::filterRecursive($this->getOptions(), static fn ($value): bool => [] !== $value),
            ],
        ];
    }

    abstract protected function type(): string;
}
