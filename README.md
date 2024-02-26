# notify

[简体中文](README-zh_CN.md) | [ENGLISH](README.md)

> Push notification sdk(Bark、Chanify、DingTalk、Discord、Email、FeiShu、Gitter、Google Chat、iGot、Logger、Mattermost、Microsoft Teams、Now Push、Ntfy、Pushback、Push、PushDeer、Pushover、PushPlus、QQ Channel Bot、Rocket Chat、ServerChan、Showdoc Push、Slack、Telegram、Webhook、WeWork、XiZhi、YiFengChuanHua、Zulip).

[![tests](https://github.com/guanguans/notify/actions/workflows/tests.yml/badge.svg)](https://github.com/guanguans/notify/actions/workflows/tests.yml)
[![check & fix styling](https://github.com/guanguans/notify/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/guanguans/notify/actions/workflows/php-cs-fixer.yml)
[![codecov](https://codecov.io/gh/guanguans/notify/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/notify)
[![Latest Stable Version](https://poser.pugx.org/guanguans/notify/v)](https://packagist.org/packages/guanguans/notify)
[![GitHub release (with filter)](https://img.shields.io/github/v/release/guanguans/notify)](https://github.com/guanguans/notify/releases)
[![Total Downloads](https://poser.pugx.org/guanguans/notify/downloads)](https://packagist.org/packages/guanguans/notify)
[![License](https://poser.pugx.org/guanguans/notify/license)](https://packagist.org/packages/guanguans/notify)

## Related project

* [https://github.com/guanguans/laravel-exception-notify](https://github.com/guanguans/laravel-exception-notify)
* [https://github.com/guanguans/yii-log-target](https://github.com/guanguans/yii-log-target)

## Platform support

* [Bark](https://github.com/Finb/Bark)
* [Chanify](https://github.com/chanify/chanify-ios)
* [DingTalk](https://developers.dingtalk.com/document/app/custom-robot-access)
* [Discord](https://discord.com/developers/docs/resources/webhook#edit-webhook-message)
* [Email](https://symfony.com/doc/current/mailer.html)
* [FeiShu](https://www.feishu.cn/hc/zh-CN/articles/360024984973)
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
* [PushPlus](https://pushplus.hxtrip.com/index)
* [QQ Channel Bot](https://bot.q.qq.com/wiki/develop/api/openapi/message/post_messages.html)
* [Rocket Chat](https://docs.rocket.chat/guides/administration/admin-panel/integrations)
* [ServerChan](https://sct.ftqq.com)
* [ShowdocPush](https://push.showdoc.com.cn/#/)
* [Slack](https://api.slack.com/messaging/webhooks)
* [Telegram](https://core.telegram.org/bots/api#sendmessage)
* Webhook
* [WeWork](https://open.work.weixin.qq.com/api/doc/90000/90136/91770)
* [XiZhi](https://xz.qqoq.net/#/index)
* [YiFengChuanHua](https://www.phprm.com/push/h5/)
* [Zulip](https://zulip.com/api/send-message)

## Requirement

* PHP >= 7.4

## Installation

```bash
composer require guanguans/notify -v
```

## Usage

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

## Testing

```bash
composer test
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
