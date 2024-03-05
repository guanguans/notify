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

use GuzzleHttp\RequestOptions;

class CertificateAuthenticator extends OptionsAuthenticator
{
    public function __construct(string $path, ?string $password = null)
    {
        parent::__construct([
            RequestOptions::CERT => \is_string($password) ? [$path, $password] : $path,
        ]);
    }
}
