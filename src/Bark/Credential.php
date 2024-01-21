<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Bark;

use Psr\Http\Message\RequestInterface;

class Credential implements \Guanguans\Notify\Foundation\Contracts\Credential
{
    public const ACCESS_TOKEN_PLACEHOLDER = '<access-token>';

    private string $accessToken;

    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request->withUri(
            $request->getUri()->withPath(str_replace(
                urlencode(self::ACCESS_TOKEN_PLACEHOLDER),
                $this->accessToken,
                $request->getUri()->getPath()
            ))
        );
    }
}
