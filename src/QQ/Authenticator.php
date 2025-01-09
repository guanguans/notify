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

namespace Guanguans\Notify\QQ;

use Guanguans\Notify\Foundation\Authenticators\BearerAuthenticator;

class Authenticator extends BearerAuthenticator
{
    public function __construct(string $appid, string $token)
    {
        parent::__construct("$appid.$token", 'Bot');
    }
}
