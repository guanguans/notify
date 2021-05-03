<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

class ChanifyClient extends AbstractClient
{
    public const ENDPOINT_URL_TEMPLATE = '%s/%s';

    /**
     * @var string
     */
    protected $baseUri = 'https://api.chanify.net/v1/sender';

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var string
     */
    protected $content;

    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $content);

        return $this;
    }

    /**
     * @return $this
     */
    public function setAccessToken(string $accessToken): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $accessToken);

        return $this;
    }

    /**
     * @return array|string[]
     */
    public function getData(): array
    {
        return [
            'text' => $this->getContent(),
        ];
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @return array|string[]
     */
    public function getParams(): array
    {
        return $this->getData();
    }

    /**
     * @return $this
     */
    public function setBaseUri(string $baseUri): self
    {
        $this->baseUri = trim($baseUri, '/');

        return $this;
    }

    /**
     * @return array|\GuzzleHttp\Promise\PromiseInterface|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string
     */
    public function send()
    {
        return $this->getHttpClient()->post($this->getEndpointUrl(), $this->getParams());
    }

    public function getEndpointUrl(): string
    {
        return sprintf(static::ENDPOINT_URL_TEMPLATE, $this->baseUri, $this->accessToken);
    }
}
