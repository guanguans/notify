<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Gitter;

use Guanguans\Notify\Foundation\Authenticators\AggregateAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\BearerAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\UriTemplateAuthenticator;

class Authenticator extends AggregateAuthenticator
{
    public function __construct(
        string $roomId,
        #[\SensitiveParameter]
        string $token
    ) {
        parent::__construct(
            new UriTemplateAuthenticator(['roomId' => $roomId]),
            new BearerAuthenticator($token),
        );
    }
}
