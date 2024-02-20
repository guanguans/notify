<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Authenticators;

use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriFactoryInterface;

class WebHookAuthenticator extends NullAuthenticator
{
    private string $webHook;

    private UriFactoryInterface $uriFactory;

    public function __construct(string $webHook, ?UriFactoryInterface $uriFactory = null)
    {
        $this->webHook = $webHook;
        $this->uriFactory = $uriFactory ?? new HttpFactory;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request->withUri($this->uriFactory->createUri($this->webHook));
    }
}
