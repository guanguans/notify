<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Credentials;

use GuzzleHttp\RequestOptions;

class ApiKeyCredential extends NullCredential
{
    private string $name;
    private string $value;
    private string $type;

    public function __construct(string $name, string $value, string $type = RequestOptions::HEADERS)
    {
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
    }

    public function applyToOptions(array $options): array
    {
        $options[$this->type][$this->name] = $this->value;

        return $options;
    }
}
