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

namespace Guanguans\Notify\WPush;

use Guanguans\Notify\Foundation\Authenticators\OptionsAuthenticator;
use GuzzleHttp\RequestOptions;

/**
 * @api
 */
class Authenticator extends OptionsAuthenticator
{
    public function __construct(
        #[\SensitiveParameter]
        string $apikey
    ) {
        parent::__construct([RequestOptions::JSON => ['apikey' => $apikey]]);
    }
}
