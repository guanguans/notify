<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\GoogleChat;

use Guanguans\Notify\Foundation\Credentials\NullCredential;
use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\UriTemplate\UriTemplate;
use Psr\Http\Message\RequestInterface;

class Credential extends NullCredential
{
    public const TEMPLATE_SPACE = '{space}';

    private string $space;
    private string $key;
    private string $token;
    private ?string $threadKey;

    public function __construct(string $space, string $token, string $key, ?string $threadKey = null)
    {
        $this->space = $space;
        $this->key = $key;
        $this->token = $token;
        $this->threadKey = $threadKey;
        $this->httpFactory = new HttpFactory;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request->withUri($this->httpFactory->createUri(
            UriTemplate::expand(urldecode((string) $request->getUri()), ['space' => $this->space])
        ));
    }

    public function applyToOptions(array $options): array
    {
        $options['query']['token'] = $this->token;
        $options['query']['key'] = $this->key;
        $options['query']['thread_key'] = $this->threadKey;

        return $options;
    }
}
