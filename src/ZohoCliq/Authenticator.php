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

namespace Guanguans\Notify\ZohoCliq;

use Guanguans\Notify\Foundation\Authenticators\AggregateAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\BearerAuthenticator;
use Guanguans\Notify\Foundation\Authenticators\UriTemplateAuthenticator;

class Authenticator extends AggregateAuthenticator
{
    public function __construct(
        string $companyId,
        string $channelUniqueName,
        #[\SensitiveParameter]
        ?string $authToken = null
    ) {
        $authenticators = [
            new UriTemplateAuthenticator([
                'companyId' => $companyId,
                'channelUniqueName' => $channelUniqueName,
            ]),
        ];

        if (null !== $authToken) {
            $authenticators[] = new BearerAuthenticator($authToken);
        }

        parent::__construct(...$authenticators);
    }

    public static function generateToken(string $clientId, string $clientSecret): string
    {
        $token = new Token($clientId, $clientSecret);

        return $token->generateToken();
    }
}
