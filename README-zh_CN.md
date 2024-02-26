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
* [Pushback](https://pushback.io/docs/getting-started)
* [Push](https://docs.push.techulus.com/api-documentation)
* [PushDeer](http://pushdeer.com)
* [Pushover](https://pushover.net)
* [Pushplus](https://pushplus.hxtrip.com/index)
* [QQ 频道机器人](https://bot.q.qq.com/wiki/develop/api/openapi/message/post_messages.html)
* [Rocket Chat](https://docs.rocket.chat/guides/administration/admin-panel/integrations)
* [Server 酱](https://sct.ftqq.com)
* [ShowdocPush](https://push.showdoc.com.cn/#/)
* [Slack](https://api.slack.com/messaging/webhooks)
* [Telegram](https://core.telegram.org/bots/api#sendmessage)
* Webhook
* [企业微信群机器人](https://open.work.weixin.qq.com/api/doc/90000/90136/91770)
* [息知](https://xz.qqoq.net/#/index)
* [一封传话](https://www.phprm.com/push/h5/)
* [Zulip](https://zulip.com/api/send-message)

## 环境要求

* PHP >= 7.4

## 安装

```bash
composer require guanguans/notify -v
```

## 使用

<details>
<summary><b>Bark</b></summary>

```php
$response = $client
    // ->verify(false)
    // ->timeout(30)
    // ->baseUri('The server address of your own deployment.')
    ->send(Guanguans\Notify\Bark\Messages\Message::make([
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
</details>

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
