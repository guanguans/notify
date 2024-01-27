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

class CertificateCredential extends NullCredential
{
    private string $path;
    private ?string $password;

    public function __construct(string $path, ?string $password = null)
    {
        $this->path = $path;
        $this->password = $password;
    }

    public function applyToOptions(array $options): array
    {
        return [
            RequestOptions::CERT => \is_string($this->password) ? [$this->path, $this->password] : $this->path,
        ] + $options;
    }
}
