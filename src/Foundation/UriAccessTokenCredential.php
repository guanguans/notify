<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation;

use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\UriTemplate\UriTemplate;
use Psr\Http\Message\RequestInterface;

class UriAccessTokenCredential extends NullCredential
{
    public const ACCESS_TOKEN_PLACEHOLDER = '{token}';

    protected string $accessToken;
    private HttpFactory $httpFactory;

    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->httpFactory = new HttpFactory();
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request->withUri($this->httpFactory->createUri(
            UriTemplate::expand(urldecode((string) $request->getUri()), ['token' => $this->accessToken])
        ));
    }
}
