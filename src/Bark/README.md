# Bark

## Usage

```php
$authenticator = new Guanguans\Notify\Bark\Authenticator('yetwhxBm7wCBSUTjeqh');
$client = new Guanguans\Notify\Bark\Client($authenticator);
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
