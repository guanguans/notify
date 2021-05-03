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
    protected $content;

    /**
     * @return array|string[]
     */
    public function getData(): array
    {
        return [
            'text' => $this->getContent(),
        ];
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
        return sprintf(static::ENDPOINT_URL_TEMPLATE, $this->baseUri, $this->token);
    }
}
