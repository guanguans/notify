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

namespace Guanguans\Notify\ServerChan;

use Guanguans\Notify\Foundation\Authenticators\OptionsAuthenticator;

class Authenticator extends OptionsAuthenticator
{
    public function __construct(
        #[\SensitiveParameter]
        string $key
    ) {
        parent::__construct([
            'base_uri' => str_starts_with($key, 'sctp')
                ? "https://$key.push.ft07.com/send"
                : "https://sctapi.ftqq.com/$key.send",
        ]);
    }
}
