<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\LarkGroupBot;

use Guanguans\Notify\Foundation\Credentials\TokenUriTemplateCredential;
use Psr\Http\Message\RequestInterface;

class UriTemplateCredential extends TokenUriTemplateCredential
{
    private ?string $secret;

    public function __construct(string $token, ?string $secret = null)
    {
        parent::__construct($token);
        $this->secret = $secret;
    }

    /**
     * @noinspection JsonEncodingApiUsageInspection
     */
    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        $request = parent::applyToRequest($request);

        if ($this->secret) {
            $body = [
                'timestamp' => $timestamp = time(),
                'sign' => $this->sign($this->secret, $timestamp),
            ] + json_decode($request->getBody()->getContents(), true);

            $request = $request->withBody($this->httpFactory->createStream(json_encode($body)));
        }

        return $request;
    }

    private function sign(string $secret, int $timestamp): string
    {
        return base64_encode(hash_hmac('sha256', '', sprintf("%s\n%s", $timestamp, $secret), true));
    }
}
