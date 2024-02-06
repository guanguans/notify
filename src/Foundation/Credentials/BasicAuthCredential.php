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

/**
 * @see https://github.com/saloonphp/saloon/blob/v3/src/Http/Auth/BasicAuthenticator.php
 * @see https://github.com/phanxipang/fansipan/blob/main/src/Middleware/Auth/BasicAuthentication.php
 * @see https://github.com/kriswallsmith/Buzz/blob/master/lib/Middleware/BasicAuthMiddleware.php
 * @see https://github.com/guzzle/guzzle/blob/7.8/src/Client.php#L400
 */
class BasicAuthCredential extends NullCredential
{
    private string $username;

    private string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function applyToOptions(array $options): array
    {
        return [
            RequestOptions::AUTH => [$this->username, $this->password],
        ] + $options;
    }
}
