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

use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Message\RequestInterface;

class WebHookCredential extends NullCredential
{
    private string $webHook;
    private HttpFactory $httpFactory;

    public function __construct(string $webHook)
    {
        $this->webHook = $webHook;
        $this->httpFactory = new HttpFactory;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request->withUri($this->httpFactory->createUri($this->webHook));
    }
}
