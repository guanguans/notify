<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

class WebhookClient extends Client
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'url',
        'message',
    ];

    public function __construct(array $options = [])
    {
        $this->sending(function (self $client): void {
            $options = $this->getMessage()->getOptions();
            unset($options['body']);
            $client->setHttpOptions($options);
        });

        parent::__construct($options);
    }

    public function setRequestMethod(string $requestMethod): self
    {
        $this->requestMethod = $requestMethod;

        return $this;
    }

    public function getRequestUrl(): string
    {
        return $this->getUrl();
    }

    public function setUrl(string $webhookUrl): self
    {
        $this->setOption('url', $webhookUrl);

        return $this;
    }

    public function getUrl(): string
    {
        return $this->getOption('url');
    }
}
