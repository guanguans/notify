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
use GuzzleHttp\UriTemplate\UriTemplate;
use Psr\Http\Message\RequestInterface;

class UriTemplateCredential extends NullCredential
{
    private array $variables;

    private HttpFactory $httpFactory;

    public function __construct(array $variables)
    {
        $this->variables = $variables;
        $this->httpFactory = new HttpFactory;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request->withUri($this->httpFactory->createUri(
            /** @see https://github.com/rize/UriTemplate */
            UriTemplate::expand(urldecode((string) $request->getUri()), $this->variables)
        ));
    }
}
