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
 * @see https://developers.google.com/hangouts/chat/how-tos/webhooks
 * @see https://developers.google.com/hangouts/chat/reference/rest/v1/spaces.messages/create#query-parameters
 */
class GoogleChatClient extends Client
{
    /**
     * @var string
     */
    public const REQUEST_URL_TEMPLATE = 'https://chat.googleapis.com/v1/spaces/%s/messages?key=%s&token=%s%s';

    /**
     * @var string
     */
    public $requestMethod = 'postJson';

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
        'space',
        'key',
        'thread_key',
    ];

    /**
     * @var mixed[]
     */
    protected $options = [
        'thread_key' => null,
    ];

    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE,
            $this->getSpace(),
            $this->getKey(),
            $this->getToken(),
            $this->getThreadKey() ? '&threadKey='.$this->getThreadKey() : ''
        );
    }

    public function getSpace(): string
    {
        return $this->getOption('space');
    }

    public function setSpace(string $space): self
    {
        return $this->setOption('space', $space);
    }

    public function getKey(): string
    {
        return $this->getOption('key');
    }

    public function setKey(string $key): self
    {
        return $this->setOption('key', $key);
    }

    public function getThreadKey(): ?string
    {
        return $this->getOption('thread_key');
    }

    public function setThreadKey(?string $threadKey): self
    {
        return $this->setOption('thread_key', $threadKey);
    }
}
