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

use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Message\RequestInterface;

class Credential implements \Guanguans\Notify\Foundation\Contracts\Credential
{
    public const ACCESS_TOKEN_PLACEHOLDER = '<access-token>';

    private string $accessToken;
    private ?string $secret;
    private HttpFactory $httpFactory;

    public function __construct(string $accessToken, string $secret = null)
    {
        $this->accessToken = $accessToken;
        $this->secret = $secret;
        $this->httpFactory = new HttpFactory();
    }

    /**
     * @noinspection JsonEncodingApiUsageInspection
     */
    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        $request = $request->withUri(
            $request->getUri()->withPath(str_replace(
                urlencode(self::ACCESS_TOKEN_PLACEHOLDER),
                $this->accessToken,
                $request->getUri()->getPath()
            ))
        );

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
