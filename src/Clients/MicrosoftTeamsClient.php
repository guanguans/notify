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

/**
 * @see https://learn.microsoft.com/zh-cn/outlook/actionable-messages/message-card-reference
 * @see https://learn.microsoft.com/zh-cn/microsoftteams/platform/webhooks-and-connectors/what-are-webhooks-and-connectors
 */
class MicrosoftTeamsClient extends Client
{
    /**
     * @var string
     */
    protected $requestMethod = 'postJson';

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
