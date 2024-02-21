<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Authenticators;

use Guanguans\Notify\Foundation\Support\Utils;
use GuzzleHttp\RequestOptions;

class PayloadAuthenticator extends NullAuthenticator
{
    private array $payload;

    private string $type;

    public function __construct(array $payload, string $type)
    {
        $this->payload = $payload;
        $this->type = $type;
    }

    public function applyToOptions(array $options): array
    {
        $options[$this->type] = array_merge(
            $options[$this->type] ?? [],
            RequestOptions::MULTIPART === $this->type ? Utils::toMultipart($this->payload) : $this->payload
        );

        return $options;
    }
}
