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
 * @see https://developer.rocket.chat/reference/api
 *
 * ```
 * // login.
 * curl --location --request POST 'https://guanguans.rocket.chat/api/v1/login' \
 * --header 'Content-type: application/json' \
 * --data-raw '{"user": "{{user_name}}", "password": "{{password}}'.
 *
 * // channels list.
 * curl --location --request GET 'https://guanguans.rocket.chat/api/v1/channels.list' \
 * --header 'X-User-Id: {{user_id}}' \
 * --header 'X-Auth-Token: {{auth_token}}' \
 * --header 'Content-type: application/json' \
 *
 * // send message.
 * curl --location --request POST 'https://guanguans.rocket.chat/api/v1/chat.postMessage' \
 * --header 'X-User-Id: {{user_id}}' \
 * --header 'X-Auth-Token: {{auth_token}}' \
 * --header 'Content-type: application/json' \
 * --data-raw '{"roomId": "{{room_id}}", "text": "This is a testing."}'
 * ```
 */
class RocketChatClient extends Client
{
    public const REQUEST_URL_TEMPLATE = '%s/api/v1/chat.postMessage';

    protected $requestMethod = 'postJson';

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
        'host',
        'userId',
        'roomId',
    ];

    public function __construct(array $options = [])
    {
        $this->sending(function (self $client) {
            $client->setHttpOptions([
                'headers' => [
                    'X-Auth-Token' => $client->getToken(),
                    'X-User-Id' => $client->getUserId(),
                ],
            ]);
        });

        parent::__construct($options);
    }

    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE, $this->getHost());
    }

    public function getHost(): string
    {
        return $this->getOption('host');
    }

    /**
     * @return $this
     */
    public function setHost(string $host): self
    {
        $this->setOption('host', $host);

        return $this;
    }

    public function getUserId(): string
    {
        return $this->getOption('userId');
    }

    /**
     * @return $this
     */
    public function setUserId(string $userId): self
    {
        $this->setOption('userId', $userId);

        return $this;
    }

    public function getRoomId(): string
    {
        return $this->getOption('roomId');
    }

    /**
     * @return $this
     */
    public function setRoomId(string $roomId): self
    {
        $this->setOption('roomId', $roomId);

        return $this;
    }

    /**
     * @throws \Guanguans\Notify\Exceptions\RuntimeException
     */
    public function getRequestParams(): array
    {
        return array_merge(parent::getRequestParams(), ['roomId' => $this->getRoomId()]);
    }
}
