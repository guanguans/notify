# notify

> Push notification sdk(Bark、Chanify、DingTalk、Discord、Email、FeiShu、Gitter、Google Chat、iGot、Logger、Mattermost、Microsoft Teams、Now Push、Ntfy、Pushback、Push、PushDeer、Pushover、PushPlus、QQ Channel Bot、Rocket Chat、ServerChan、Showdoc Push、Slack、Telegram、Webhook、WeWork、XiZhi、YiFengChuanHua、Zulip).

[![tests](https://github.com/guanguans/notify/actions/workflows/tests.yml/badge.svg)](https://github.com/guanguans/notify/actions/workflows/tests.yml)
[![check & fix styling](https://github.com/guanguans/notify/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/guanguans/notify/actions/workflows/php-cs-fixer.yml)
[![codecov](https://codecov.io/gh/guanguans/notify/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/notify)
[![Latest Stable Version](https://poser.pugx.org/guanguans/notify/v)](https://packagist.org/packages/guanguans/notify)
[![GitHub release (with filter)](https://img.shields.io/github/v/release/guanguans/notify)](https://github.com/guanguans/notify/releases)
[![Total Downloads](https://poser.pugx.org/guanguans/notify/downloads)](https://packagist.org/packages/guanguans/notify)
[![License](https://poser.pugx.org/guanguans/notify/license)](https://packagist.org/packages/guanguans/notify)

## Platform support

* [Bark](./src/Bark/README.md)
* [Chanify](./src/Chanify/README.md)
* [DingTalk](./src/DingTalk/README.md)
* [Discord](./src/Discord/README.md)
* [~~Gitter~~](./src/Gitter/README.md)
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

## Related repository

* [https://github.com/guanguans/laravel-exception-notify](https://github.com/guanguans/laravel-exception-notify)
* [https://github.com/guanguans/yii-log-target](https://github.com/guanguans/yii-log-target)

## Requirement

* PHP >= 7.4

## Installation

```bash
composer require guanguans/notify -v
```

## Usage example

```php
// 1. Create authenticator
$authenticator = new \Guanguans\Notify\Bark\Authenticator('yetwhxBm7wCBSUTjeqh');

// 2. Create client
$client = new \Guanguans\Notify\Bark\Client($authenticator);

// 3. Create message
$message = \Guanguans\Notify\Bark\Messages\Message::make([
    'title' => 'This is title.',
    'body' => 'This is body.',
    // 'copy' => 'This is copy.',
    // 'url' => 'https://github.com/guanguans/notify',
    // 'sound' => 'bell',
    // 'group' => 'group',
    // 'icon' => 'https://avatars0.githubusercontent.com/u/25671453?s=200&v=4',
    // 'level' => 'passive',
    // 'badge' => 5,
    // 'isArchive' => 1,
    // 'autoCopy' => 1,
    // 'automaticallyCopy' => 1,
])
    ->copy('This is copy.')
    ->url('https://github.com/guanguans/notify');

// 4. Send message
$response = $client
    // ->baseUri('The server address of your own deployment.')
    // ->timeout(30)
    // ->verify(false)
    ->send($message)
    ->dump()
    // ->throw()
    ->json();
```

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
