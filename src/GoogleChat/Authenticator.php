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

namespace Guanguans\Notify\GoogleChat;

use Guanguans\Notify\Foundation\Authenticators\AggregateAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\OptionsAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\UriTemplateAuthenticator;
use GuzzleHttp\RequestOptions;

class Authenticator extends AggregateAuthenticator
{
    public function __construct(
        string $spaceId,
        #[\SensitiveParameter]
        string $key,
        #[\SensitiveParameter]
        string $token,
        ?string $threadKey = null
    ) {
        $query = ['key' => $key, 'token' => $token];
        $threadKey and $query['threadKey'] = $threadKey;

        $authenticators = [
            new UriTemplateAuthenticator(['spaceId' => $spaceId]),
            new OptionsAuthenticator([RequestOptions::QUERY => $query]),
        ];

        parent::__construct(...$authenticators);
    }
}
