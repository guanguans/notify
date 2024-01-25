<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Credentials;

use Psr\Http\Message\RequestInterface;

/**
 * @see https://github.com/kriswallsmith/Buzz/blob/master/lib/Middleware/WsseAuthMiddleware.php
 */
class WsseAuthCredential extends NullCredential
{
    private string $username;
    private string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        $nonce = substr(sha1(uniqid('', true)), 0, 16);
        $created = date('c');
        $digest = base64_encode(sha1(base64_decode($nonce).$created.$this->password, true));

        $wsse = sprintf(
            'UsernameToken Username="%s", PasswordDigest="%s", Nonce="%s", Created="%s"',
            $this->username,
            $digest,
            $nonce,
            $created
        );

        return $request
            ->withHeader('Authorization', 'WSSE profile="UsernameToken"')
            ->withHeader('X-WSSE', $wsse);
    }
}
