# notify

[简体中文](README.md) | [ENGLISH](README-EN.md)

> Multi platform notification SDK(Bark、Chanify、DingTalk、Email、FeiShu、Gitter、Google Chat、iGot、Logger、Mattermost、Now Push、PushBack、Push、PushDeer、PushPlus、Rocket Chat、ServerChan、WeWork、XiZhi、Zulip). - 多平台通知 SDK(Bark、Chanify、钉钉群机器人、邮件、飞书群机器人、Gitter、Google Chat、iGot、Logger、Mattermost、Now Push、PushBack、Push、PushDeer、PushPlus、Rocket Chat、Server 酱、企业微信群机器人、息知、Zulip)。

[![Tests](https://github.com/guanguans/notify/workflows/Tests/badge.svg)](https://github.com/guanguans/notify/actions)
[![Check & fix styling](https://github.com/guanguans/notify/workflows/Check%20&%20fix%20styling/badge.svg)](https://github.com/guanguans/notify/actions)
[![codecov](https://codecov.io/gh/guanguans/notify/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/notify)
[![Latest Stable Version](https://poser.pugx.org/guanguans/notify/v)](//packagist.org/packages/guanguans/notify)
[![Total Downloads](https://poser.pugx.org/guanguans/notify/downloads)](//packagist.org/packages/guanguans/notify)
[![License](https://poser.pugx.org/guanguans/notify/license)](//packagist.org/packages/guanguans/notify)

## Related project

* [https://github.com/guanguans/laravel-exception-notify](https://github.com/guanguans/laravel-exception-notify)
* [https://github.com/guanguans/yii-log-target](https://github.com/guanguans/yii-log-target)

## Platform support

* [Bark](https://github.com/Finb/Bark)
* [Chanify](https://github.com/chanify/chanify-ios)
* [DingTalk](https://developers.dingtalk.com/document/app/custom-robot-access)
* [Email](https://symfony.com/doc/current/mailer.html)
* [FeiShu](https://www.feishu.cn/hc/zh-CN/articles/360024984973)
* [Gitter](https://developer.gitter.im/docs/messages-resource)
* [Google Chat](https://developers.google.com/hangouts/chat/how-tos/webhooks)
* [iGot](http://hellyw.com/#/)
* [Logger](https://github.com/php-fig/log)
* [Mattermost](https://api.mattermost.com)
* [Now Push](https://nowpush.io/api-docs/)
* [PushBack](https://pushback.io/docs/getting-started)
* [Push](https://docs.push.techulus.com/api-documentation)
* [PushDeer](http://pushdeer.com)
* [PushPlus](https://pushplus.hxtrip.com/index)
* [Rocket Chat](https://docs.rocket.chat/guides/administration/admin-panel/integrations)
* [ServerChan](https://sct.ftqq.com)
* [WeWork](https://open.work.weixin.qq.com/api/doc/90000/90136/91770)
* [XiZhi](https://xz.qqoq.net/#/index)
* [Zulip](https://zulip.com/api/send-message)

## Requirement

* PHP >= 7.2

## Installation

```bash
$ composer require guanguans/notify -vvv
```

## Usage

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
<summary><b>DingTalk</b></summary>

```php
// Text Message
Factory::dingTalk()
    ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
    ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee51730')
    ->setMessage((new \Guanguans\Notify\Messages\DingTalk\TextMessage([
        'content'   => 'This is content(keyword).',
        // 'atMobiles' => [13948484984],
        // 'atUserIds' => [123456],
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
        // 'atUserIds' => [123456],
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
<summary><b>Email</b></summary>

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
<summary><b>FeiShu</b></summary>

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
    ->setChannelId('sat5ohbs5byixd86tmxtk13b5w')
    ->setMessage(
        new \Guanguans\Notify\Messages\MattermostMessage([
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
// Normal
Factory::pushDeer()
    // ->setBaseUri('The server address of your own deployment.')
    ->setToken('Your PushDeer Token')
    ->setMessage(new \Guanguans\Notify\Messages\PushDeerMessage('This is title.', 'This is desp. **normal**.', ''))
    ->send();

// Markdown
Factory::pushDeer()
    ->setToken('Your PushDeer Token')
    ->setMessage(new \Guanguans\Notify\Messages\PushDeerMessage('**This is title.**', '## Head2', 'markdown'))
    ->send();

// Image
Factory::pushDeer()
    ->setToken('Your PushDeer Token')
    ->setMessage(new \Guanguans\Notify\Messages\PushDeerMessage('https://www.baidu.com/img/PCtm_d9c8750bed0b3c7d089fa7d55720d6cf.png', 'This is desp.', 'image'))
    ->send();
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
<summary><b>Server Chan</b></summary>

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
<summary><b>WeWork</b></summary>

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
<summary><b>XiZhi</b></summary>

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

## Testing

```bash
$ composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

* [guanguans](https://github.com/guanguans)
* [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
