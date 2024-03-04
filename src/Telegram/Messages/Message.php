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
use Guanguans\Notify\Foundation\Support\Utils;
use GuzzleHttp\RequestOptions;

abstract class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;

    public function toHttpOptions(): array
    {
        return [
            RequestOptions::HEADERS => ['Content-Type' => 'application/json'],
            RequestOptions::MULTIPART => Utils::multipartFor(
                Arr::filterRecursive($this->getOptions(), static fn ($value): bool => [] !== $value)
            ),
        ];
    }
}
