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

namespace Guanguans\Notify\ServerChan;

use Guanguans\Notify\Foundation\Authenticators\OptionsAuthenticator;

class Authenticator extends OptionsAuthenticator
{
    public function __construct(
        #[\SensitiveParameter]
        string $key
    ) {
        parent::__construct([
            'base_uri' => 0 === strncmp($key, 'sctp', 4)
                ? "https://$key.push.ft07.com/send"
                : "https://sctapi.ftqq.com/$key.send",
        ]);
    }
}
