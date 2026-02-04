<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation\Authenticators;

use GuzzleHttp\RequestOptions;

class CertificateAuthenticator extends OptionsAuthenticator
{
    public function __construct(
        string $path,
        #[\SensitiveParameter]
        ?string $password = null
    ) {
        parent::__construct([RequestOptions::CERT => \is_string($password) ? [$path, $password] : $path]);
    }
}
