# notify

[简体中文](README-zh_CN.md) | [ENGLISH](README.md)

> 推送通知 sdk(Bark、Chanify、钉钉群机器人、Discord、邮件、飞书群机器人、Gitter、Google Chat、iGot、Logger、Mattermost、Microsoft Teams、Now Push、Ntfy、Pushback、Push、PushDeer、Pushover、Pushplus、QQ 频道机器人、Rocket Chat、Server 酱、Showdoc Push、Slack、Telegram、Webhook、企业微信群机器人、息知、一封传话、Zulip)。

[![tests](https://github.com/guanguans/notify/actions/workflows/tests.yml/badge.svg)](https://github.com/guanguans/notify/actions/workflows/tests.yml)
[![check & fix styling](https://github.com/guanguans/notify/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/guanguans/notify/actions/workflows/php-cs-fixer.yml)
[![codecov](https://codecov.io/gh/guanguans/notify/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/notify)
[![Latest Stable Version](https://poser.pugx.org/guanguans/notify/v)](https://packagist.org/packages/guanguans/notify)
[![GitHub release (with filter)](https://img.shields.io/github/v/release/guanguans/notify)](https://github.com/guanguans/notify/releases)
[![Total Downloads](https://poser.pugx.org/guanguans/notify/downloads)](https://packagist.org/packages/guanguans/notify)
[![License](https://poser.pugx.org/guanguans/notify/license)](https://packagist.org/packages/guanguans/notify)

## 相关项目

* [https://github.com/guanguans/laravel-exception-notify](https://github.com/guanguans/laravel-exception-notify)
* [https://github.com/guanguans/yii-log-target](https://github.com/guanguans/yii-log-target)

## 平台支持

* [Bark](./src/Bark/README.md)
* [Chanify](./src/Chanify/README.md)
* [DingTalk](./src/DingTalk/README.md)
* [Discord](./src/Discord/README.md)
* [Gitter](./src/Gitter/README.md)
* [GoogleChat](./src/GoogleChat/README.md)
* [IGot](./src/IGot/README.md)
* [Lark](./src/Lark/README.md)
* [Mattermost](./src/Mattermost/README.md)
* [MicrosoftTeams](./src/MicrosoftTeams/README.md)
* [NowPush](./src/NowPush/README.md)
* [Ntfy](./src/Ntfy/README.md)
* [Push](./src/Push/README.md)
* [Pushback](./src/Pushback/README.md)
* [Pushover](./src/Pushover/README.md)
* [Pushplus](./src/Pushplus/README.md)
* [QQ](./src/QQ/README.md)
* [RocketChat](./src/RocketChat/README.md)
* [ServerChan](./src/ServerChan/README.md)
* [ShowdocPush](./src/ShowdocPush/README.md)
* [Slack](./src/Slack/README.md)
* [Telegram](./src/Telegram/README.md)
* [WeWork](./src/WeWork/README.md)
* [XiZhi](./src/XiZhi/README.md)
* [YiFengChuanHua](./src/YiFengChuanHua/README.md)
* [Zulip](./src/Zulip/README.md)

## 环境要求

* PHP >= 7.4

## 安装

```bash
composer require guanguans/notify -v
```

## 使用示例

```php
// 1. 创建认证器
$authenticator = new \Guanguans\Notify\Bark\Authenticator('yetwhxBm7wCBSUTjeqh');

// 2. 创建客户端
$client = new \Guanguans\Notify\Bark\Client($authenticator);

// 3. 创建并且发送消息
$response = $client
    // ->verify(false)
    // ->timeout(30)
    // ->baseUri('The server address of your own deployment.')
    ->send(\Guanguans\Notify\Bark\Messages\Message::make([
        'title' => 'This is title.',
        'body' => 'This is body.',
        'copy' => 'This is copy.',
        'url' => 'https://github.com/guanguans/notify',
        'sound' => 'bell',
        'group' => 'group',
        // 'icon' => 'https://avatars0.githubusercontent.com/u/25671453?s=200&v=4',
        // 'level' => 'passive',
        // 'badge' => 5,
        // 'isArchive' => 1,
        // 'autoCopy' => 1,
        // 'automaticallyCopy' => 1,
    ]))
    // ->dump()
    ->throw();
```

## 测试

```bash
composer test
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

MIT 许可证 (MIT)。有关更多信息，请参见[协议文件](LICENSE)。
