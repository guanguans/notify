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

namespace Guanguans\Notify\ZohoCliq\Messages;

use Guanguans\Notify\Foundation\Concerns\AsFormParams;
use Guanguans\Notify\Foundation\Message;

/**
 * @method self clientId(mixed $clientId)
 * @method self clientSecret(mixed $clientSecret)
 * @method self code(mixed $code)
 * @method self grantType(mixed $grantType)
 * @method self redirectUri(mixed $redirectUri)
 * @method self refreshToken(mixed $refreshToken)
 * @method self scope(mixed $scope)
 */
final class AccessTokenMessage extends Message // @internal
{
    use AsFormParams;
    protected array $defined = [
        'client_id',
        'client_secret',
        'grant_type',
        'scope',

        'code',
        'redirect_uri',
        'refresh_token',
    ];
    protected array $options = [
        'grant_type' => 'client_credentials',
        'scope' => 'ZohoCliq.Webhooks.CREATE',
    ];

    public function toHttpUri(): string
    {
        return 'oauth/v2/token';
    }
}
