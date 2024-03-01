<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\QQ;

use Guanguans\Notify\Foundation\Contracts\Authenticator;

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
class Client extends \Guanguans\Notify\Foundation\Client
{
    public function __construct(?Authenticator $authenticator = null)
    {
        parent::__construct($authenticator);
        $this->baseUri('https://api.sgroup.qq.com/'); // sandbox https://sandbox.api.sgroup.qq.com/
    }
}
