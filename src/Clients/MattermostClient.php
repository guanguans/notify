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
 * @see https://api.mattermost.com
 *
 * ```
 * // user login.
 * curl --location --request POST 'https://guanguans.cloud.mattermost.com/api/v4/users/login' \
 * --header 'Content-Type: application/json' \
 * --data-raw '{"login_id":"{{user_name}}","password":"{{password}}"}'
 *
 * // channel list.
 * curl --location --request GET 'https://guanguans.cloud.mattermost.com/api/v4/channels' \
 * --header 'Authorization: Bearer {{token}}' \
 * --header 'Content-Type: application/json' \
 *
 * // send a post.
 * curl --location --request POST 'https://guanguans.cloud.mattermost.com/api/v4/posts' \
 * --header 'Authorization: Bearer {{token}}' \
 * --header 'Content-Type: application/json' \
 * --data-raw '{"message":"This is a testing.","channel_id":"{{channel_id}}"}'
 * ```
 */
class MattermostClient extends Client
{
    public const REQUEST_URL_TEMPLATE = '%s/api/v4/posts';

    public $requestMethod = 'postJson';

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
        'baseUri',
        'channel_id',
    ];

    public function __construct(array $options = [])
    {
        parent::__construct($options);

        $this->sending(function (self $client) {
            $client->setHttpOptions([
                'headers' => [
                    'Authorization' => 'Bearer '.$client->getToken(),
                ],
            ]);
        });
    }

    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE, rtrim($this->getBaseUri(), '/'));
    }

    public function getBaseUri(): string
    {
        return $this->getOption('baseUri');
    }

    /**
     * @return $this
     */
    public function setBaseUri(string $baseUri): self
    {
        $this->setOption('baseUri', $baseUri);

        return $this;
    }

    public function getChannelId(): string
    {
        return $this->getOption('channel_id');
    }

    /**
     * @return $this
     */
    public function setChannelId(string $channelId): self
    {
        $this->setOption('channel_id', $channelId);

        return $this;
    }

    public function getRequestParams(): array
    {
        return array_merge(parent::getRequestParams(), [
            'channel_id' => $this->getChannelId(),
        ]);
    }
}
