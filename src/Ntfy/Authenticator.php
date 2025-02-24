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
        parent::__construct(...match (\func_num_args()) {
            0 => [
                new NullAuthenticator,
            ],
            1 => [
                new BearerAuthenticator($usernameOrToken),
                new OptionsAuthenticator([
                    RequestOptions::QUERY => [RequestOptions::AUTH => $usernameOrToken],
                ]),
            ],
            2 => [
                new BasicAuthenticator($usernameOrToken, $password),
            ],
            default => throw new InvalidArgumentException('The number of arguments must be 0, 1 or 2.'),
        });
    }
}
