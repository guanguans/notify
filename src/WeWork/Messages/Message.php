<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\WeWork\Messages;

use Guanguans\Notify\Foundation\Concerns\AsBody;

abstract class Message extends \Guanguans\Notify\Foundation\Message
{
    // use AsBody;

    public function toHttpUri(): string
    {
        return 'cgi-bin/webhook/send?key={token}';
    }

    protected function toPayload(): array
    {
        return [
            'msgtype' => $this->type(),
            $this->type() => parent::toPayload(),
        ];
    }

    abstract protected function type(): string;
}
