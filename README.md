# notify

[简体中文](README.md) | [ENGLISH](README-EN.md)

> Multi platform notification SDK(Bark、Chanify、DingTalk、FeiShu、Gitter、RocketChat、ServerChan、WeWork、XiZhi、Zulip). - 多平台通知 SDK(Bark、Chanify、钉钉群机器人、飞书群机器人、Gitter、RocketChat、Server 酱、企业微信群机器人、息知、Zulip)。

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
* [飞书群机器人](https://www.feishu.cn/hc/zh-CN/articles/360024984973)
* [Gitter](https://developer.gitter.im/docs/messages-resource)
* [RocketChat](https://docs.rocket.chat/guides/administration/admin-panel/integrations)
* [Server 酱](https://sct.ftqq.com)
* [企业微信群机器人](https://open.work.weixin.qq.com/api/doc/90000/90136/91770)
* [息知](https://xz.qqoq.net/#/index)
* [Zulip](https://zulip.com/api/send-message)

## 环境要求

* PHP >= 7.2

## 安装

```bash
$ composer require guanguans/notify -vvv
```

## 使用

### Bark

```php
use Guanguans\Notify\Factory;
use Guanguans\Notify\Clients\Client;

$barkMessage = new \Guanguans\Notify\Messages\BarkMessage([
    'title' => 'This is title.',
    'text'  => 'This is text.',
    'copy'  => 'This is copy.',
    'url'   => 'https://github.com/guanguans/notify',
    // 'sound'             => 'bell',
    // 'isArchive'         => 1,
    // 'automaticallyCopy' => 1,
]);
Factory::bark()
    // ->setBaseUri('The server address of your own deployment.')
    ->setToken('ihnPXb8KDj9dHStfQ5c')
    ->setMessage($barkMessage)
    ->sending(function (Client $client){
        // do something for before send
    })
    ->sended(function (Client $client){
        // do something for after send
    })
    ->send();
```

### Chanify

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

### 钉钉群机器人

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
]);
$message->addBtn([
    'title'     => 'This is title 1',
    'actionURL' => 'https://github.com/guanguans/notify',
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

### 飞书群机器人

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

### Gitter

```php
Factory::gitter()
    ->setToken('b9e7931ecacb08b7ab4df5e98bc149d33d7faf1')
    ->setRoomId('61af21b96da03739848bfef')
    ->setMessage(new \Guanguans\Notify\Messages\GitterMessage('This is testing.'))
    ->send();
```

### RocketChat

```php
Factory::rocketChat()
    ->setToken('EemSHx9ioqdmrWouS/yYpmhqDSyd7CqmSAnyBfKezLyzotswbRSpkD9MCNxqtPL')
    ->setHost('https://guanguans.rocket.chat')
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

### Server 酱

```php
Factory::serverChan()
    ->setToken('SCT35149Thtf1g2Bc14QJuQ6HFpW5YG')
    ->setMessage(new \Guanguans\Notify\Messages\ServerChanMessage('This is title.', 'This is desp.'))
    ->send();

// Check
Factory::serverChan()->check(3334849, 'SCTJlJV1J87hS');
```

### 企业微信群机器人

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

### 息知

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

### Zulip

```php
// Private Message
Factory::zulip()
    ->setToken('Mc0b7YBmibOVjLdk7KKSpT9SJLi1h')
    ->setEmail('798314049@qq.com')
    ->setHost('https://coole.zulipchat.com')
    ->setMessage(new \Guanguans\Notify\Messages\Zulip\PrivateMessage('798314049@qq.com', 'This is testing.'))
    ->send();

// Stream Message
Factory::zulip()
    ->setToken('Mc0b7YBmibOVjLdk7KKSpT9SJLi1h')
    ->setEmail('798314049@qq.com')
    ->setHost('https://coole.zulipchat.com')
    ->setMessage(new \Guanguans\Notify\Messages\Zulip\StreamMessage([
        'to' => 'coole',
        'content' => 'This is testing.',
        'topic' => 'bug',
        //'queue_id' => '1593114627:0',
        //'local_id' => '100.01',
    ]))
    ->send();
```

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
