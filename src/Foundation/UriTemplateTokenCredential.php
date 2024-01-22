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

class UriTemplateTokenCredential extends NullCredential
{
    public const TEMPLATE_TOKEN = '{token}';

    protected string $token;
    protected HttpFactory $httpFactory;

    public function __construct(string $token)
    {
        $this->token = $token;
        $this->httpFactory = new HttpFactory();
    }

    /**
     * @see https://github.com/rize/UriTemplate
     */
    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request->withUri($this->httpFactory->createUri(
            UriTemplate::expand(urldecode((string) $request->getUri()), ['token' => $this->token])
        ));
    }
}
