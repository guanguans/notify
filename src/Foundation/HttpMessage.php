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

use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

abstract class HttpMessage extends Message
{
    protected RequestFactoryInterface $requestFactory;
    protected StreamFactoryInterface $streamFactory;
    protected UploadedFileFactoryInterface $uploadedFileFactory;
    protected UriFactoryInterface $uriFactory;

    public function __construct(array $options = [])
    {
        parent::__construct($options);
        $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        $this->uploadedFileFactory = Psr17FactoryDiscovery::findUploadedFileFactory();
        $this->uriFactory = Psr17FactoryDiscovery::findUriFactory();
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

    public function toQuery(): string
    {
        return http_build_query($this->options);
    }

    protected function protocolVersion(): string
    {
        return '1.1';
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

    abstract protected function method(): string;

    abstract protected function uri(): string;
}
