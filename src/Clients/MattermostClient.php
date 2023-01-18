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
    /**
     * @var string
     */
    public const REQUEST_URL_TEMPLATE = '%s/api/v4/posts';

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
        'base_uri',
    ];

    public function __construct(array $options = [])
    {
        $this->sending(static function (self $client): void {
            $client->setHttpOptions([
                'headers' => [
                    'Authorization' => 'Bearer '.$client->getToken(),
                ],
            ]);
        });

        parent::__construct($options);
    }

    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE, rtrim($this->getBaseUri(), '/'));
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
