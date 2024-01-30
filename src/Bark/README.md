# Bark

## Usage

```php
$credential = new Guanguans\Notify\Bark\Credential('yetwhxBm7wCBSUTjeqh');
$client = new Guanguans\Notify\Bark\Client($credential);

$response = $client->send(Guanguans\Notify\Bark\Messages\Message::make([
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
]));
```
