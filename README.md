# notify

[简体中文](README.md) | [ENGLISH](README-EN.md)

> 推送通知 sdk(Bark、Chanify、钉钉群机器人、Discord、邮件、飞书群机器人、Gitter、Google Chat、iGot、Logger、Mattermost、Microsoft Teams、Now Push、Ntfy、PushBack、Push、PushDeer、Pushover、PushPlus、QQ 频道机器人、Rocket Chat、Server 酱、Showdoc Push、Slack、Telegram、Webhook、企业微信群机器人、息知、Zulip、一封传话聚合推送)。

[![Tests](https://github.com/guanguans/notify/workflows/Tests/badge.svg)](https://github.com/guanguans/notify/actions)
[![Check & fix styling](https://github.com/guanguans/notify/workflows/Check%20&%20fix%20styling/badge.svg)](https://github.com/guanguans/notify/actions)
[![codecov](https://codecov.io/gh/guanguans/notify/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/notify)
[![Latest Stable Version](https://poser.pugx.org/guanguans/notify/v)](//packagist.org/packages/guanguans/notify)
[![Total Downloads](https://poser.pugx.org/guanguans/notify/downloads)](//packagist.org/packages/guanguans/notify)
[![License](https://poser.pugx.org/guanguans/notify/license)](//packagist.org/packages/guanguans/notify)

## 相关项目

* [https://github.com/guanguans/laravel-exception-notify](https://github.com/guanguans/laravel-exception-notify)
* [https://github.com/guanguans/yii-log-target](https://github.com/guanguans/yii-log-target)

## 平台支持

* [Bark](https://github.com/Finb/Bark)
* [Chanify](https://github.com/chanify/chanify-ios)
* [钉钉群机器人](https://developers.dingtalk.com/document/app/custom-robot-access)
* [Discord](https://discord.com/developers/docs/resources/webhook#edit-webhook-message)
* [邮件](https://symfony.com/doc/current/mailer.html)
* [飞书群机器人](https://www.feishu.cn/hc/zh-CN/articles/360024984973)
* [Gitter](https://developer.gitter.im/docs/messages-resource)
* [Google Chat](https://developers.google.com/hangouts/chat/how-tos/webhooks)
* [iGot](http://hellyw.com/#/)
* [Logger](https://github.com/php-fig/log)
* [Mattermost](https://api.mattermost.com)
* [Microsoft Teams](https://www.microsoft.com/zh-cn/microsoft-teams/teams-for-work)
* [Now Push](https://nowpush.io/api-docs/)
* [Ntfy](https://ntfy.sh/)
* [PushBack](https://pushback.io/docs/getting-started)
* [Push](https://docs.push.techulus.com/api-documentation)
* [PushDeer](http://pushdeer.com)
* [Pushover](https://pushover.net)
* [PushPlus](https://pushplus.hxtrip.com/index)
* [QQ 频道机器人](https://bot.q.qq.com/wiki/develop/api/openapi/message/post_messages.html)
* [Rocket Chat](https://docs.rocket.chat/guides/administration/admin-panel/integrations)
* [Server 酱](https://sct.ftqq.com)
* [Showdoc Push](https://push.showdoc.com.cn/#/)
* [Slack](https://api.slack.com/messaging/webhooks)
* [Telegram](https://core.telegram.org/bots/api#sendmessage)
* Webhook
* [企业微信群机器人](https://open.work.weixin.qq.com/api/doc/90000/90136/91770)
* [息知](https://xz.qqoq.net/#/index)
* [Zulip](https://zulip.com/api/send-message)
* [一封传话聚合推送](https://www.phprm.com/push/h5/)

## 环境要求

* PHP >= 7.2

## 安装

```bash
$ composer require guanguans/notify -vvv
```

## 使用

<details>
<summary><b>Bark</b></summary>

```php
use Guanguans\Notify\Factory;
use Guanguans\Notify\Clients\Client;

$barkMessage = new \Guanguans\Notify\Messages\BarkMessage([
    'title' => 'This is title.',
    'body' => 'This is body.',
    'copy' => 'This is copy.',
    'url' => 'https://github.com/guanguans/notify',
    'sound' => 'bell',
    'group' => 'group',
    // 'icon' => 'https://avatars0.githubusercontent.com/u/25671453?s=200&v=4',
    // 'group' => 'group',
    // 'level' => 'passive',
    // 'badge' => 5,
    // 'isArchive' => 1,
    // 'autoCopy' => 1,
    // 'automaticallyCopy' => 1,
]);
Factory::bark()
    // ->setBaseUri('The server address of your own deployment.')
    ->setToken('ihnPXb8KDj9dHStfQ5c')
    ->setMessage($barkMessage)
    ->sending(function (Client $client){
        // do something for before send
        dump($client->getRequestParams());
    })
    ->sended(function (Client $client){
        // do something for after send
        dump($client->getResponse());
    })
    ->send();
```
</details>

<details>
<summary><b>Chanify</b></summary>

```php
// Text Message
Factory::chanify()
    // ->setBaseUri('The server address of your own deployment.')
    ->setToken('fh4gGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFGhR7vAyf8Uj5UQhhK4n6QfVzih96QyIECAEQAQ.E0eBnLbfNwWrWZ1YSAZfkCQWZAPdBl6pVr26lRf6Srs')
    ->setMessage((new \Guanguans\Notify\Messages\Chanify\TextMessage([
        'title'    => 'This is title.',
        'text'     => 'This is text.',
        // 'copy'     => 'This is copy.',
        // 'actions'  => [
        //     "ActionName1|http://<action host>/<action1>",
        //     "ActionName2|http://<action host>/<action2>",
        // ],
        // 'autocopy' => 0,
        // 'sound'    => 0,
        // 'priority' => 10,
    ])))
    ->send();

// Link Message
Factory::chanify()
    // ->setBaseUri('The server address of your own deployment.')
    ->setToken('fh4gGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFGhR7vAyf8Uj5UQhhK4n6QfVzih96QyIECAEQAQ.E0eBnLbfNwWrWZ1YSAZfkCQWZAPdBl6pVr26lRf6Srs')
    ->setMessage((new \Guanguans\Notify\Messages\Chanify\LinkMessage([
        'link'     => 'https://github.com/guanguans/notify',
        // 'sound'    => 0,
        // 'priority' => 10,
    ])))
    ->send();
```
</details>

<details>
<summary><b>钉钉群机器人</b></summary>

```php
// Text Message
Factory::dingTalk()
    ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
    ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730')
    ->setMessage((new \Guanguans\Notify\Messages\DingTalk\TextMessage([
        'content'   => 'This is content(keyword).',
        // 'atMobiles' => [13948484984],
        // 'atDingtalkIds' => [123456],
        // 'isAtAll'   => false,
    ])))
    ->send();

// Link Message
Factory::dingTalk()
    ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
    ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730')
    ->setMessage((new \Guanguans\Notify\Messages\DingTalk\LinkMessage([
        'title'      => 'This is content.',
        'text'       => 'This is text(keyword).',
        'messageUrl' => 'https://github.com/guanguans/notify',
        'picUrl'     => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    ])))
    ->send();

// Markdown Message
Factory::dingTalk()
    ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
    ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730')
    ->setMessage((new \Guanguans\Notify\Messages\DingTalk\MarkdownMessage([
        'title' => 'This is title.',
        'text'  => '> This is text(keyword).',
        // 'atMobiles' => [13948484984],
        // 'atDingtalkIds' => [123456],
        // 'isAtAll'   => false,
    ])))
    ->send();

// Feed Card Message
$message = new \Guanguans\Notify\Messages\DingTalk\FeedCardMessage([
    'title'      => 'This is title(keyword) 0.',
    'messageURL' => 'https://github.com/guanguans/notify',
    'picURL'     => 'https://avatars.githubusercontent.com/u/22309277?v=4'
]);
Factory::dingTalk()
    ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
    ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730')
    ->setMessage($message)
    ->send();

// Single Action Card Message
Factory::dingTalk()
    ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
    ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730')
    ->setMessage(new \Guanguans\Notify\Messages\DingTalk\SingleActionCardMessage([
        'title'       => 'This is title(keyword).',
        'text'        => 'This is text.',
        'singleTitle' => 'This is singleTitle.',
        'singleURL'   => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        // 'btnOrientation' => 1
    ]))
    ->send();

// Btns Action Card Message
$message = new \Guanguans\Notify\Messages\DingTalk\BtnsActionCardMessage([
    'title'          => 'This is title(keyword).',
    'text'           => 'This is text.',
    // 'hideAvatar'     => 1,
    // 'btnOrientation' => 1,
    'btns' => [
        [
            'title'     => 'This is title 1',
            'actionURL' => 'https://github.com/guanguans/notify',
        ]
    ]
]);
$message->addBtn([
    'title'     => 'This is title 2',
    'actionURL' => 'https://github.com/guanguans/notify',
]);
Factory::dingTalk()
    ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
    ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730')
    ->setMessage($message)
    ->send();
```
</details>

<details>
<summary><b>Discord</b></summary>

```php
$message = new \Guanguans\Notify\Messages\DiscordMessage([
    'content' => 'This is content.',
    //'username' => 'notify bot.',
    //'avatar_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    //'tts' => false,
    //'embeds' => $embed = [
    //    'title' => 'This is title.',
    //    'type' => 'This is type.',
    //    'description' => 'This is description.',
    //    'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    //    'color' => '0365D6',
    //    'footer' => [
    //        'text' => 'This is text.',
    //        'icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    //    ],
    //    'image' => [
    //        'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    //    ],
    //    'thumbnail' => [
    //        'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    //    ],
    //    'author' => [
    //        'name' => 'This is name.',
    //        'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4.',
    //        'icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    //    ],
    //    'fields' => [
    //        [
    //            'name' => 'This is name.',
    //            'value' => 'This is value.',
    //            'inline' => false,
    //        ],
    //    ],
    ],
]);

Factory::discord()
    ->setWebhookUrl('https://discord.com/api/webhooks/955407924304425000/o7RfCGxek_o8kfR6Q9i')
    ->setMessage($message)
    ->send();
```
</details>

<details>
<summary><b>邮件</b></summary>

```bash
# 安装依赖
$ composer require symfony/mailer -vvv
```

```php
$email = \Guanguans\Notify\Messages\EmailMessage::create()
    ->from('from@qq.com')
    ->to('to@qq.com')
    //->cc('cc@example.com')
    //->bcc('bcc@example.com')
    //->replyTo('replyTo@example.com')
    // ->priority(\Guanguans\Notify\Messages\EmailMessage::PRIORITY_HIGH)
    ->subject('This is a testing for notify.')
    // ->html('<p>Sending emails is fun again!</p>')
    ->text('This is a testing.');

Factory::mailer()
    ->setDsn('smtp://user:pass@smtp.qq.com:465?verify_peer=0')
    ->setMessage($email)
    ->send();
```
</details>

<details>
<summary><b>飞书群机器人</b></summary>

```php
// Text Message
Factory::feiShu()
    ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
    ->setSecret('iigDOvnsIn6aFS1pYHHEHh')
    ->setMessage(new \Guanguans\Notify\Messages\FeiShu\TextMessage('This is title(keyword).'))
    ->send();

// Post Message
$post = [
    'zh_cn' => [
        'title'   => '项目更新通知',
        'content' => [
            [
                [
                    "tag"  => "text",
                    "text" => "项目有更新(keyword)"
                ]
            ]
        ]
    ]
];
Factory::feiShu()
    ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
    ->setSecret('iigDOvnsIn6aFS1pYHHEHh')
    ->setMessage(new \Guanguans\Notify\Messages\FeiShu\PostMessage($post))
    ->send();

// Image Message
Factory::feiShu()
    ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
    ->setSecret('iigDOvnsIn6aFS1pYHHEHh')
    ->setMessage(new \Guanguans\Notify\Messages\FeiShu\ImageMessage('img_ecffc3b9-8f14-400f-a014-05eca1a4xxxx'))
    ->send();

// ShareChat Message
Factory::feiShu()
    ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
    ->setSecret('iigDOvnsIn6aFS1pYHHEHh')
    ->setMessage(new \Guanguans\Notify\Messages\FeiShu\ShareChatMessage('oc_f5b1a7eb27ae2c7b6adc2a74fafxxxxx'))
    ->send();

// Card Message
$card = [
    'elements' => [
        [
            'tag'  => 'div',
            'text' => [
                'content' => '**西湖(keyword)**，位于浙江省杭州市西湖区龙井路1号，杭州市区西部，景区总面积49平方千米，汇水面积为21.22平方千米，湖面面积为6.38平方千米。',
                'tag'     => 'lark_md',
            ],
        ],
    ],
];
Factory::feiShu()
    ->setToken('b6eb70d9-6e19-4f87-af48-348b0281866c')
    ->setSecret('iigDOvnsIn6aFS1pYHHEHh')
    ->setMessage(new \Guanguans\Notify\Messages\FeiShu\CardMessage($card))
    ->send();
```
</details>

<details>
<summary><b>Gitter</b></summary>

```php
Factory::gitter()
    ->setToken('b9e7931ecacb08b7ab4df5e98bc149d33d7faf1')
    ->setRoomId('61af21b96da03739848bfef')
    ->setMessage(new \Guanguans\Notify\Messages\GitterMessage('This is testing.'))
    ->send();
```
</details>

<details>
<summary><b>Google Chat</b></summary>

```php
Factory::googleChat()
    ->setToken('accessToken')
    ->setKey('accessKey')
    ->setSpace('space')
    // ->setThreadKey('threadKey')
    ->setMessage(new \Guanguans\Notify\Messages\GoogleChatMessage([
        'text' => 'This is a testing.',
    ]))
    ->send();
```
</details>

<details>
<summary><b>iGot</b></summary>

```php
Factory::iGot()
    ->setToken('5dcd2f91d38cc47447414')
    ->setMessage(
        new \Guanguans\Notify\Messages\IGotMessage([
            'content' => 'This is content.',
            // 'title' => 'This is title.',
            // 'url' => 'https://www.github.com/guanguans/notify',
            // 'automaticallyCopy' => 1,
            // 'urgent' => 1,
            // 'copy' => 'This is copy.',
            // 'detail' => [
            //     'title' => 'This is detail title.',
            //     'content' => 'This is detail content.',
            // ],
        ])
    )
    ->send();
```
</details>

<details>
<summary><b>Logger</b></summary>

```php
Factory::logger()
    ->setLogger(new \Psr\Log\NullLogger())
    // ->setLevel('warning')
    ->setMessage(new \Guanguans\Notify\Messages\LoggerMessage('This is a testing.'))
    ->send();
```
</details>

<details>
<summary><b>Mattermost</b></summary>

```php
Factory::mattermost()
    ->setBaseUri('https://guanguans.cloud.mattermost.com')
    ->setToken('r7jezodttibgueijpahyyfh1qa')
    ->setMessage(
        new \Guanguans\Notify\Messages\MattermostMessage([
            'channel_id' => 'sat5ohbs5byixd86tmxtk13',
            'message' => 'This is a testing.',
            // 'is_pinned' => true,
            // 'create_at' => 1639041968509,
            // 'edit_at' => 1639041968509,
            // 'root_id' => '',
            // 'original_id' => '',
            // 'type' => '',
            // 'pending_post_id' => '1639041968509abc',
            // 'participants' => null,
            // 'props' => ['key' => 'value'],
            // 'file_ids' => ['o3x4y157jff5xydf5m91bft1oo'],
        ])
    )
    ->send();
```
</details>

<details>
<summary><b>Microsoft Teams</b></summary>

```php
$microsoftTeamsMessage = new MicrosoftTeamsMessage([
    'correlationId' => 'This is correlationId.',
    'expectedActors' => [
        'john@contoso.com',
    ],
    'originator' => 'This is originator.',
    'summary' => 'This is summary.',
    'themeColor' => '0076D7',
    'hideOriginalBody' => false,
    'title' => 'This is title.',
    'text' => 'This is text.',
    'sections' => [],
    'potentialAction' => [],
]);

$microsoftTeamsMessage
    ->addSection([
        'title' => 'This is title.',
        'startGroup' => true,
        'activityImage' => 'This is activityImage.',
        'activityTitle' => 'This is activityTitle.',
        'activitySubtitle' => 'This is activitySubtitle.',
        'activityText' => 'This is activityText.',
        'heroImage' => 'This is heroImage.',
        'text' => 'This is text.',
        'facts' => [
            [
                'name' => 'This is name.',
                'value' => 'This is value.',
            ],
        ],
        'images' => [
            'This is images.',
        ],
        'potentialAction' => [],
    ])
    ->addPotentialAction([
        '@type' => 'OpenUri',
        'name' => 'This is name.',
        'targets' => [
            [
                'os' => 'default',
                'uri' => 'https://learn.microsoft.com/outlook/actionable-messages',
            ],
        ],
    ])
    ->addPotentialAction([
        '@type' => 'HttpPOST',
        'name' => 'This is name.',
        'target' => 'https://learn.microsoft.com/outlook/actionable-messages',
        'headers' => [
            [
                'name' => 'X-Version',
                'value' => 'v1.0.0',
            ],
        ],
        'body' => [
            'field' => 'value',
        ],
        'bodyContentType' => 'application/x-www-form-urlencoded',
    ])
    ->addPotentialAction([
        '@type' => 'ActionCard',
        'name' => 'This is name.',
        'inputs' => [
            [
                '@type' => 'TextInput',
                'id' => 'comment',
                'isRequired' => true,
                'title' => 'This is title.',
                'value' => 'This is value.',
                'isMultiline' => true,
            ],
        ],
        'actions' => [],
    ])
    ->addPotentialAction([
        '@type' => 'InvokeAddInCommand',
        'name' => 'This is name.',
        'addInId' => '527104a1-f1a5-475a-9199-7a968161c870',
        'desktopCommandId' => 'show',
        'initializationContext' => [
            'property1' => 'This is property1.',
            'property2' => 'This is property2.',
        ],
    ]);

Factory::microsoftTeams()
    ->setWebhookUrl('url')
    ->setMessage($microsoftTeamsMessage)
    ->send();
```
</details>

<details>
<summary><b>Now Push</b></summary>

```php
// Note Message
Factory::nowPush()
    ->setToken('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL')
    ->setMessage(new \Guanguans\Notify\Messages\NowPush\NoteMessage('This is a note.'))
    ->send();

// Image Message
Factory::nowPush()
    ->setToken('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL')
    ->setMessage(new \Guanguans\Notify\Messages\NowPush\ImageMessage('https://www.nowpush.app/assets/img/welcome/welcome-mockup.png'))
    ->send();

// Link Message
Factory::nowPush()
    ->setToken('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL')
    ->setMessage(new \Guanguans\Notify\Messages\NowPush\LinkMessage('https://github.com/guanguans/notify'))
    ->send();

// User Info
Factory::nowPush()
    ->setToken('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL')
    ->getUser();
```
</details>

<details>
<summary><b>Ntfy</b></summary>

```php
$ntfyMessage = new NtfyMessage([
    'topic' => 'guanguans',
    'message' => 'This is message.',
    'title' => 'This is title.',
    'priority' => 1,
    'tags' => ['tag1', 'tag2'],
    'click' => 'https://example.com',
    'attach' => 'https://www.guanguans.cn',
    'icon' => 'https://www.guanguans.cn',
    'filename' => 'file.jpg',
    'cache' => 'no',
    'firebase' => 'no',
    // 'actions' => [],
    // 'delay' => '30min, 9am',
    // 'email' => 'xxx@qq.com',
]);

$ntfyMessage
    ->addAction([
        'action' => 'broadcast',
        'label' => 'This is label.',
        'intent' => 'This is intent.',
        'extras' => [
            'field' => 'value',
        ],
    ])
    ->addAction([
        'action' => 'http',
        'label' => 'This is label.',
        'url' => 'https://www.guanguans.cn',
        'method' => 'POST',
        'headers' => [
            'Authorization' => 'Bearer ...',
        ],
        'body' => '{"field":"value"}',
    ])
    ->addAction([
        'action' => 'view',
        'label' => 'This is label.',
        'url' => 'https://www.guanguans.cn',
        'clear' => true,
    ]);

Factory::ntfy()
    // ->setBaseUri('The server address of your own deployment.')
    // ->setUsername('username')
    // ->setPassword('password')
    ->setMessage($ntfyMessage)
    ->send();
```
</details>

<details>
<summary><b>PushBack</b></summary>

```php
Factory::pushBack()
    ->setToken('at_uDCCK8gdHJPN613lASV')
    // ->setSynchonousMode()
    ->setMessage(
        new \Guanguans\Notify\Messages\PushBackMessage([
            'id' => 'User_1730',
            'title' => 'This is title.',
            // 'body' => 'This is body.',
            // 'action1' => 'action1',
            // 'action2' => 'action2',
            // 'reply' => 'reply',
        ])
    )
    ->send();
```
</details>

<details>
<summary><b>Push</b></summary>

```php
Factory::push()
    ->setToken('5db80e8a-1f9b-4f98-929a-75892cedc')
    ->setMessage(
        new \Guanguans\Notify\Messages\PushMessage([
            'title' => 'This is a title.',
            'body' => 'This is a body.',
            // 'link' => 'https://github.com/guanguans/notify',
            // 'image' => 'https://www.nowpush.app/assets/img/welcome/welcome-mockup.png',
        ])
    )
    ->send();
```
</details>

<details>
<summary><b>PushDeer</b></summary>

```php
Factory::pushDeer()
    ->setToken('PDU8024TTt9Yvx4wkm08SmSXAY9pnPycl5RrB')
    ->setMessage(new \Guanguans\Notify\Messages\PushDeerMessage('## This is text.', '> This is desp.', 'markdown'))
    ->send();
```
</details>

<details>
<summary><b>Pushover</b></summary>

```php
Factory::pushover()
    ->setToken('abs9tevjnpu2p7x1yii8uf23')
    ->setUserToken('uz86ivgu7xkizpdpdo65vw2c')
    ->setMessage(
        new \Guanguans\Notify\Messages\PushoverMessage([
            'message' => 'This is message.',
            // 'title' => 'This is title.',
            // 'timestamp' => time(),
            // 'priority' => 2,
            // 'url' => 'https://www.guanguans.cn',
            // 'url_title' => 'This is URL title.',
            // 'sound' => 'none',
            // 'retry' => 60,
            // 'expire' => 3600,
            // 'html' => 1,
            // 'monospace' => 0,
            // 'callback' => 'https://www.guanguans.cn/',
            // 'device' => 'This is device.',
            // 'attachment' => '/Users/yaozm/Downloads/xxx.png',
        ])
    )
    ->send();

// sounds
Factory::pushover()
    ->setToken('abs9tevjnpu2p7x1yii8uf23')
    ->sounds();
```
</details>

<details>
<summary><b>PushPlus</b></summary>

```php
Factory::pushPlus()
    ->setToken('762e3f7efd764ad5acaa9cc26ac20')
    ->setMessage(new \Guanguans\Notify\Messages\PushPlusMessage([
        'content' => 'This is content.',
        // 'title' => 'This is title.',
        // 'template' => 'html',
        // 'topic' => 'topic',
    ]))
    ->send();
```
</details>

<details>
<summary><b>QQ 频道机器人</b></summary>

```bash
# 安装依赖
$ composer require textalk/websocket -vvv
```

```php
// 获取用户频道列表
Factory::qqChannelBot()
    ->setAppid('102001')
    ->setToken('eghXYBXQH0QXBByb8Zj4VeRGterQG')
    ->getUserChannels();

// 获取子频道列表    
Factory::qqChannelBot()
    ->setAppid('102001')
    ->setToken('eghXYBXQH0QXBByb8Zj4VeRGterQG')
    ->getSubChannels(5099581822453968); // 频道 ID

// 发送频道消息
Factory::qqChannelBot()
    ->setAppid('102001')
    ->setToken('eghXYBXQH0QXBByb8Zj4VeRGterQG')
    ->setChannelId('4317') // 子频道 ID
    // ->sandboxEnvironment()
    // ->setSecret('3yfBSaUCfy3zlQr5')
    ->setMessage(
        \Guanguans\Notify\Messages\QqChannelBotMessage::create([
            'content' => 'This is content.',
            'image' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
            // 'msg_id' => '3yfBSa',
            // 'embed' => [],
            // 'ark' => [],
            // 'message_reference' => [],
            // 'markdown' => [],
        ])
    )
    ->send();
```
</details>

<details>
<summary><b>Rocket Chat</b></summary>

```php
Factory::rocketChat()
    ->setToken('EemSHx9ioqdmrWouS/yYpmhqDSyd7CqmSAnyBfKezLyzotswbRSpkD9MCNxqtPL')
    ->setBaseUri('https://guanguans.rocket.chat')
    ->setMessage(
        new \Guanguans\Notify\Messages\RocketChatMessage([
            'alias' => '报警机器人',
            'emoji' => ':warning:',
            'text' => 'This is a testing. ',
            // 'attachments' => [
            //     [
            //         'title' => 'This is a title.',
            //         'title_link' => 'https://rocket.chat',
            //         'text' => 'This is a text.',
            //         'image_url' => 'http://www.xxx.png',
            //         'color' => '#764FA5',
            //     ],
            // ],
        ])
    )
    ->send();
```
</details>

<details>
<summary><b>Server 酱</b></summary>

```php
Factory::serverChan()
    ->setToken('SCT35149Thtf1g2Bc14QJuQ6HFpW5YG')
    ->setMessage(new \Guanguans\Notify\Messages\ServerChanMessage('This is title.', 'This is desp.'))
    ->send();

// Check
Factory::serverChan()->check(3334849, 'SCTJlJV1J87hS');
```
</details>

<details>
<summary><b>Showdoc Push</b></summary>

```php
Factory::showdocPush()
    ->setToken('f096edb95f92540219a41e47060eeb6d9461')
    ->setMessage(new \Guanguans\Notify\Messages\ShowdocPushMessage('This is title.', 'This is content.'))
    ->send();
```
</details>

<details>
<summary><b>Slack</b></summary>

```php
$message = new \Guanguans\Notify\Messages\SlackMessage([
    'text' => 'This is text.',
    //'channel' => '#general',
    //'username' => 'notify bot',
    //'icon_emoji' => ':ghost:',
    //'icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
    //'unfurl_links' => true,
    //'attachments' => $attachment = [
    //    'fallback' => 'Required text summary of the attachment',
    //    'text' => 'Optional text that should appear within the attachment',
    //    'pretext' => 'Optional text that should appear above the formatted data',
    //    'color' => '#36a64f',
    //    'fields' => [
    //        [
    //            'title' => 'Required Field Title',
    //            'value' => 'Text value of the field.',
    //            'short' => false,
    //        ],
    //    ],
    //],
]);

Factory::slack()
    ->setWebhookUrl('https://hooks.slack.com/services/TPU9A98MT/B038KNUC0GY/6pKH3vfa3mjlUPcgLSjzR')
    ->setMessage($message)
    ->send();
```
</details>

<details>
<summary><b>Telegram</b></summary>

```php
// getUpdates(Chat ID)
Factory::telegram()
    ->setToken('5146570:AAF-Pi1MBPa46wdyobfZZdZL1-PlDfrZ')
    ->getUpdates();

// Text
\Guanguans\Notify\Messages\Telegram\TextMessage::create([
    'chat_id' => 50443416,
    'text' => '*This is text*',
    'parse_mode' => 'MarkdownV2',
    // 'entities' => [],
    // 'disable_web_page_preview' => true,
    // 'disable_notification' => true,
    // 'protect_content' => true,
    // 'reply_to_message_id' => 5,
    // 'allow_sending_without_reply' => true,
    // 'reply_markup' => [],
]);

Factory::telegram()
    ->setToken('5146570195:AAF-Pi1MBPa46wdyobfZZdZL')
    ->setMessage($message)
    ->send();
```
</details>

<details>
<summary><b>Webhook</b></summary>

```php
$message = \Guanguans\Notify\Messages\WebhookMessage::create([
    'content' => 'This is content.',
    'username' => 'notify bot.',
])
// ->setHeaders(['Accept' => '*/*'])
// ->setQuery([['foo' => 'bar']])
->setVerify(false);

Factory::webhook()
    ->setUrl('https://discord.com/api/webhooks/955407924304425000/o7RfCGxek_o8kfR6Q9iGKtTdRJ')
    // ->setRequestMethod('postJson')
    ->setMessage($message)
    ->send();
```
</details>

<details>
<summary><b>企业微信群机器人</b></summary>

```php
// Text Message
Factory::weWork()
    ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778f')
    ->setMessage((new \Guanguans\Notify\Messages\WeWork\TextMessage([
        'content'               => 'This is content.',
        // 'mentioned_list'        => ["wangqing", "@all"],
        // 'mentioned_mobile_list' => ["13800001111", "@all"],
    ])))
    ->send();

// Markdown Message
Factory::weWork()
    ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778f')
    ->setMessage(new \Guanguans\Notify\Messages\WeWork\MarkdownMessage("# This is title.\n This is content."))
    ->send();

// Image Message
Factory::weWork()
    ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778f')
    ->setMessage(new \Guanguans\Notify\Messages\WeWork\ImageMessage('https://avatars.githubusercontent.com/u/22309277?v=4'))
    ->send();

// News Message
$message = new \Guanguans\Notify\Messages\WeWork\NewsMessage([
    'title'       => 'This is title1.',
    'description' => 'This is description.',
    'url'         => 'https://github.com/guanguans/notify',
    'picurl'      => 'https://avatars.githubusercontent.com/u/22309277?v=4',
]);
$message->addArticle([
    'title'       => 'This is title2.',
    'description' => 'This is description.',
    'url'         => 'https://github.com/guanguans/notify',
    'picurl'      => 'https://avatars.githubusercontent.com/u/22309277?v=4',
]);
Factory::weWork()
    ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778f')
    ->setMessage($message)
    ->send();
```
</details>

<details>
<summary><b>息知</b></summary>

```php
// Single
Factory::xiZhi()
    // ->setType('single')
    ->setToken('XZd60aea56567ae39a1b1920cbc42bb5')
    ->setMessage(new \Guanguans\Notify\Messages\XiZhiMessage('This is title.', 'This is content.'))
    ->send();

// Channel
Factory::xiZhi()
    ->setType('channel')
    ->setToken('XZ8da15b55a6725497232d87298bcd34')
    ->setMessage(new \Guanguans\Notify\Messages\XiZhiMessage('This is title.', 'This is content.'))
    ->send();
```
</details>

<details>
<summary><b>Zulip</b></summary>

```php
// Private Message
Factory::zulip()
    ->setToken('Mc0b7YBmibOVjLdk7KKSpT9SJLi1h')
    ->setEmail('798314049@qq.com')
    ->setBaseUri('https://coole.zulipchat.com')
    ->setMessage(new \Guanguans\Notify\Messages\Zulip\PrivateMessage('798314049@qq.com', 'This is testing.'))
    ->send();

// Stream Message
Factory::zulip()
    ->setToken('Mc0b7YBmibOVjLdk7KKSpT9SJLi1h')
    ->setEmail('798314049@qq.com')
    ->setBaseUri('https://coole.zulipchat.com')
    ->setMessage(new \Guanguans\Notify\Messages\Zulip\StreamMessage([
        'to' => 'coole',
        'content' => 'This is testing.',
        'topic' => 'bug',
        //'queue_id' => '1593114627:0',
        //'local_id' => '100.01',
    ]))
    ->send();
```
</details>

<details>
<summary><b>一封传话聚合推送</b></summary>

```php
Factory::yiFengChuanHua()
    ->setToken('204dd77ce4a6f221')
    ->setMessage(new \Guanguans\Notify\Messages\YiFengChuanHuaMessage([
        'head' => 'This is title.',
        'body' => 'This is content.',
    ]))
    ->send();
```
</details>

## 测试

```bash
$ composer test
```

## 变更日志

请参阅 [CHANGELOG](CHANGELOG.md) 获取最近有关更改的更多信息。

## 贡献指南

请参阅 [CONTRIBUTING](.github/CONTRIBUTING.md) 有关详细信息。

## 安全漏洞

请查看[我们的安全政策](../../security/policy)了解如何报告安全漏洞。

## 贡献者

* [guanguans](https://github.com/guanguans)
* [所有贡献者](../../contributors)

## 协议

MIT 许可证（MIT）。有关更多信息，请参见[协议文件](LICENSE)。
