<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Lark\Messages;

abstract class AbstractMessage extends \Guanguans\Notify\Foundation\AbstractMessage
{
    final public function toHttpUri(): string
    {
        return 'open-apis/bot/v2/hook/{token}';
    }

    /**
     * @return array<string, mixed>
     */
    protected function toPayload(): array
    {
        return [
            'msg_type' => $this->type(),
            'content' => parent::toPayload(),
        ];
    }

    abstract protected function type(): string;
}
