<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\XiZhi\Messages;

use Guanguans\Notify\Foundation\HttpMessage;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

class SingleMessage extends HttpMessage
{
    protected array $defined = [
        'title',
        'content',
    ];

    public function __construct(string $title, ?string $content = null)
    {
        parent::__construct([
            'title' => $title,
            'content' => $content,
        ]);
    }

    public function toRequest(): RequestInterface
    {
        $request = $this->requestFactory->createRequest($this->method(), $this->uri());
        $protocolVersion = $this->protocolVersion();
        if ($protocolVersion) {
            $request->withProtocolVersion($protocolVersion);
        }

        $body = $this->body();
        if ($body) {
            $request = $request->withBody($this->body());
        }

        foreach ($this->headers() as $key => $value) {
            $request = $request->withHeader($key, $value);
        }

        return $request;
    }

    protected function protocolVersion(): string
    {
        return '1.1';
    }

    protected function uri(): string
    {
        return 'https://xizhi.qqoq.net/token.send';
    }

    protected function method(): string
    {
        return 'POST';
    }

    protected function headers(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    protected function body(): ?StreamInterface
    {
        return $this->streamFactory->createStream((string) $this);
    }
}
