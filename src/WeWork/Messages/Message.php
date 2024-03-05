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

use GuzzleHttp\RequestOptions;

abstract class Message extends \Guanguans\Notify\Foundation\Message
{
    public function toHttpUri(): string
    {
        return 'cgi-bin/webhook/send?key={token}';
    }

    /**
     * @throws \JsonException
     */
    public function toHttpOptions(): array
    {
        return [
            RequestOptions::HEADERS => ['Content-Type' => 'application/json'],
            RequestOptions::BODY => json_encode(
                [
                    'msgtype' => $this->type(),
                    $this->type() => $this->getOptions(),
                ],
                JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE
            ),
        ];
    }

    abstract protected function type(): string;
}
