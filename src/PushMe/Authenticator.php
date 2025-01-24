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

namespace Guanguans\Notify\PushMe;

use Guanguans\Notify\Foundation\Authenticators\OptionsAuthenticator;
use GuzzleHttp\RequestOptions;

class Authenticator extends OptionsAuthenticator
{
    public function __construct(?string $pushKey = null, ?string $tempKey = null)
    {
        parent::__construct(
            [RequestOptions::JSON => ['push_key' => $pushKey, 'temp_key' => $tempKey]],
            true
        );
    }
}