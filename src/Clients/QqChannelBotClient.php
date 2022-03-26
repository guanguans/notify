<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

use Wrench\Client as WrenchClient;

/**
 * @see https://bot.q.qq.com/wiki
 * @see https://bot.q.qq.com/wiki/develop/api/openapi/message/post_messages.html
 *
 * ```
 * 1. 获取主频道信息
 * curl --location --request GET 'https://sandbox.api.sgroup.qq.com/users/@me/guilds' \
 * --header 'Authorization: Bot 102001.eghXYBXQH0QXBByb8Zj4VeRGterQG'
 *
 * 2. 创建子频道
 * curl --location --request POST 'https://sandbox.api.sgroup.qq.com/guilds/5099581822453968879/channels' \
 * --header 'Authorization: Bot 102001.eghXYBXQH0QXBByb8Zj4VeRGterQG' \
 * --form 'name="测试子频道"'
 *
 * 3. 获取 websocket 网关
 * curl --location --request GET 'https://sandbox.api.sgroup.qq.com/gateway' \
 * --header 'Authorization: Bot 102001.eghXYBXQH0QXBByb8Zj4VeRGterQG'
 *
 * 4. 连接网关
 * wss://sandbox.api.sgroup.qq.com/websocket
 *
 * 5. 发送认证消息认证网关
 * {
 *     "op": 2,
 *     "d": {
 *         "token": "102001.eghXYBXQH0QXBByb8Zj4VeRGterQG",
 *         "intents": 512,
 *         "shard": [
 *             0,
 *             4
 *         ],
 *         "properties": {
 *             "$os": "linux",
 *             "$browser": "chrome",
 *             "$device": "pc"
 *         }
 *     }
 * }
 *
 * 6. 发送频道消息
 * curl --location --request POST 'https://sandbox.api.sgroup.qq.com/channels/4317819/messages' \
 * --header 'Authorization: Bot 102001.eghXYBXQH0QXBByb8Zj4VeRGterQG' \
 * --form 'content="This is content."'
 * ```
 */
class QqChannelBotClient extends Client
{
    /**
     * @var \Wrench\Client
     */
    protected static $webSocketClient;

    /**
     * @var array
     */
    protected $webSocketOptions = [];

    public const REQUEST_URL_TEMPLATE = [
        'production' => 'https://api.sgroup.qq.com/channels/%s/messages',
        'sandbox' => 'https://sandbox.api.sgroup.qq.com/channels/%s/messages',
    ];

    public const WSS_GATEWAY = [
        'production' => 'wss://api.sgroup.qq.com/websocket',
        'sandbox' => 'wss://sandbox.api.sgroup.qq.com/websocket',
    ];

    /**
     * @var string[]
     */
    protected $defined = [
        'appid',
        'token',
        'secret',
        'environment',
        'channel_id',
        'message',
    ];

    /**
     * @var string[]
     */
    protected $options = [
        'environment' => 'production',
    ];

    public function __construct(array $options = [])
    {
        $this->sending(function (self $client) {
            $client->setHttpOptions([
                'headers' => [
                    'Authorization' => sprintf('Bot %s.%s', $client->getAppid(), $client->getToken()),
                ],
            ]);
        });

        $this->sending(function (self $client) {
            if (! self::$webSocketClient instanceof WrenchClient) {
                self::$webSocketClient = new WrenchClient(
                    $wssGateway = self::WSS_GATEWAY[$this->getEnvironment()],
                    str_replace('wss://', 'https://', $wssGateway),
                    $this->webSocketOptions
                );
            }

            self::$webSocketClient->connect();
            self::$webSocketClient->sendData(json_encode([
                'op' => 2, // https://bot.q.qq.com/wiki/develop/api/gateway/opcode.html
                'd' => [
                    'token' => $client->getAppid().'.'.$client->getToken(),
                    'intents' => 0 | 1 << 9, // https://bot.q.qq.com/wiki/develop/api/gateway/intents.html
                ],
            ]));
            self::$webSocketClient->disconnect();
        });

        parent::__construct($options);
    }

    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE[$this->getEnvironment()], $this->getChannelId());
    }

    public function sandboxEnvironment(bool $sandboxEnvironment = true)
    {
        $this->setOption('environment', $sandboxEnvironment ? 'sandbox' : 'production');

        return $this;
    }

    public function productionEnvironment(bool $productionEnvironment = true)
    {
        $this->setOption('environment', $productionEnvironment ? 'production' : 'sandbox');

        return $this;
    }

    public function getEnvironment(): string
    {
        return $this->getOption('environment');
    }

    public function setAppid(int $appid)
    {
        $this->setOption('appid', $appid);

        return $this;
    }

    public function getAppid(): int
    {
        return $this->getOption('appid');
    }

    public function setSecret(string $secret)
    {
        $this->setOption('secret', $secret);

        return $this;
    }

    public function getSecret(): string
    {
        return $this->getOption('secret');
    }

    public function setChannelId(string $channelId)
    {
        $this->setOption('channel_id', $channelId);

        return $this;
    }

    public function getChannelId(): string
    {
        return $this->getOption('channel_id');
    }

    public function setWebSocketOptions(array $webSocketOptions)
    {
        $this->webSocketOptions = $webSocketOptions;

        return $this;
    }

    public function requestApi(string $uri, string $method = 'get', array $data = [])
    {
        return $this->wrapSendCallbacksWithRequestAsync(function () use ($data, $uri, $method) {
            return $this->getHttpClient()
                ->{$method}(
                    str_replace('channels/%s/messages', ltrim($uri, '/'), self::REQUEST_URL_TEMPLATE[$this->getEnvironment()]),
                    $data
                );
        });
    }

    /**
     * 获取用户频道列表.
     */
    public function getUserChannels()
    {
        return $this->requestApi('users/@me/guilds');
    }

    /**
     * 创建子频道.
     */
    public function createSubChannel(int $guildId, array $data)
    {
        return $this->requestApi("guilds/$guildId/channels", 'post', $data);
    }

    /**
     * 获取子频道列表.
     */
    public function getSubChannels(int $guildId)
    {
        return $this->requestApi("guilds/$guildId/channels");
    }
}
