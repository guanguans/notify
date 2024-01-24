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

class DigestAuthCredential extends NullCredential
{
    private string $username;
    private string $password;
    private string $digest;

    public function __construct(string $username, string $password, string $digest)
    {
        $this->username = $username;
        $this->password = $password;
        $this->digest = $digest;
    }

    public function applyToOptions(array $options): array
    {
        return [
            RequestOptions::AUTH => [$this->username, $this->password, $this->digest],
        ] + $options;
    }
}
