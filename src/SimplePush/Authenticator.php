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

namespace Guanguans\Notify\SimplePush;

use Guanguans\Notify\Foundation\Authenticators\OptionsAuthenticator;
use GuzzleHttp\RequestOptions;

class Authenticator extends OptionsAuthenticator
{
    public function __construct(string $key)
    {
        parent::__construct([
            RequestOptions::JSON => ['key' => $key],
        ]);
    }
}
