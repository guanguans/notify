<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

/**
 * @see https://discord.com/developers/docs/resources/webhook#edit-webhook-message
 */
class DiscordClient extends Client
{
    /**
     * @var string[]
     */
    protected $defined = [
        'webhook_url',
        'message',
    ];

    public function getRequestUrl(): string
    {
        return $this->getWebhookUrl();
    }

    public function setWebhookUrl(string $webhookUrl): self
    {
        $this->setOption('webhook_url', $webhookUrl);

        return $this;
    }

    public function getWebhookUrl(): string
    {
        return $this->getOption('webhook_url');
    }
}
