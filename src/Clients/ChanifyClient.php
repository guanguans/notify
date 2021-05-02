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
    public const GATEWAY_TEMPLATE = '%s/%s';

    /**
     * @var string
     */
    protected $baseUri = 'https://api.chanify.net/v1/sender';

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $content;

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->setOption('content', $content);

        return $this;
    }

    public function setToken(string $token)
    {
        $this->setOption('token', $token);

        return $this;
    }

    public function getData()
    {
        return [
            'text' => $this->getContent(),
        ];
    }

    public function getFormat(): string
    {
        return 'array';
    }

    public function getParams()
    {
        return $this->getData();
    }

    public function getGateway()
    {
        return sprintf(static::GATEWAY_TEMPLATE, $this->baseUri, $this->token);
    }

    public function setBaseUri(string $baseUri): void
    {
        $this->baseUri = $baseUri;
    }

    public function send()
    {
        return $this->getHttpClient()->post($this->getGateway(),
            $this->getParams()
        );
    }
}
