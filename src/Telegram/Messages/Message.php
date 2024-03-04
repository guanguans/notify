<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Telegram\Messages;

use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\Foundation\Support\Arr;
use GuzzleHttp\RequestOptions;

class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;

    public function toHttpOptions(): array
    {
        return [
            // RequestOptions::JSON => $this->getOptions(),
            RequestOptions::JSON => Arr::filterRecursive($this->getOptions(), static fn ($value): bool => [] !== $value),
        ];
    }

    public function toHttpUri(): string
    {
        return 'bot{token}/sendMessage';
    }
}
