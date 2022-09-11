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
 * @see https://docs.rocket.chat/guides/administration/admin-panel/integrations
 *
 * ```
 * curl --location --request POST 'https://guanguans.rocket.chat/hooks/{{token}}' \
 * --header 'Content-Type: application/json' \
 * --data-raw '{"alias":"chatbot","emoji":":ghost:","text":"This is a testing.","attachments":[]}'
 * ```
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
    /**
     * @var string
     */
    public const REQUEST_URL_TEMPLATE = '%s/hooks/%s';

    /**
     * @var string
     */
    protected $requestMethod = 'postJson';

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
        'base_uri',
    ];

    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE, $this->getBaseUri(), $this->getToken());
    }

    public function getBaseUri(): string
    {
        return $this->getOption('base_uri');
    }

    /**
     * @return $this
     */
    public function setBaseUri(string $baseUri): self
    {
        $this->setOption('base_uri', $baseUri);

        return $this;
    }
}
