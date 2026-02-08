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

namespace Guanguans\Notify\Foundation\Authenticators;

use Psr\Http\Message\RequestInterface;

/**
 * @api
 */
class WsseAuthenticator extends NullAuthenticator
{
    public function __construct(
        private readonly string $username,
        #[\SensitiveParameter]
        private readonly string $password
    ) {}

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        $nonce = substr(sha1(uniqid('', true)), 0, 16);
        $created = date('c');
        $digest = base64_encode(sha1(base64_decode($nonce, true).$created.$this->password, true));

        $wsse = \sprintf(
            'UsernameToken Username="%s", PasswordDigest="%s", Nonce="%s", Created="%s"',
            $this->username,
            $digest,
            $nonce,
            $created,
        );

        return $request
            ->withHeader('Authorization', 'WSSE profile="UsernameToken"')
            ->withHeader('X-WSSE', $wsse);
    }
}
