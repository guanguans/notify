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

namespace Guanguans\Notify\Ntfy;

use Guanguans\Notify\Foundation\Authenticators\AggregateAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\BasicAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\BearerAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\NullAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\OptionsAuthenticator;
use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use GuzzleHttp\RequestOptions;

class Authenticator extends AggregateAuthenticator
{
    public function __construct(
        ?string $usernameOrToken = null,
        #[\SensitiveParameter]
        ?string $password = null
    ) {
        parent::__construct(...match (true) {
            !isset($usernameOrToken) && !isset($password) => [
                new NullAuthenticator,
            ],
            isset($usernameOrToken) && !isset($password) => [
                new BearerAuthenticator($usernameOrToken),
                new OptionsAuthenticator([
                    RequestOptions::QUERY => [RequestOptions::AUTH => $usernameOrToken],
                ]),
            ],
            isset($usernameOrToken, $password) => [
                new BasicAuthenticator($usernameOrToken, $password),
            ],
            default => throw new InvalidArgumentException('When the password is not null, the usernameOrToken must be not null.'),
        });
    }
}
