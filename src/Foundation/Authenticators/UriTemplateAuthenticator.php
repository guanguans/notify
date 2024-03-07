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
use GuzzleHttp\UriTemplate\UriTemplate;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriFactoryInterface;

/**
 * @see https://github.com/guzzle/uri-template
 * @see https://github.com/rize/UriTemplate
 */
class UriTemplateAuthenticator extends NullAuthenticator
{
    private array $variables;

    private UriFactoryInterface $uriFactory;

    public function __construct(array $variables, ?UriFactoryInterface $uriFactory = null)
    {
        $this->variables = $variables;
        $this->uriFactory = $uriFactory ?? new HttpFactory;
    }

    /**
     * @noinspection ToStringCallInspection
     */
    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request->withUri(
            $this->uriFactory->createUri(
                UriTemplate::expand(urldecode((string) $request->getUri()), $this->variables)
            )
        );
    }
}
