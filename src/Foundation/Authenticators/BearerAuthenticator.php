<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation\Authenticators;

use GuzzleHttp\RequestOptions;

class BearerAuthenticator extends OptionsAuthenticator
{
    public function __construct(
        #[\SensitiveParameter]
        string $token,
        ?string $bearer = 'Bearer'
    ) {
        parent::__construct([RequestOptions::HEADERS => ['Authorization' => ltrim("$bearer $token")]]);
    }
}
