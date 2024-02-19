# XiZhi

## Usage

```php
$authenticator = new Guanguans\Notify\XiZhi\Authenticator('XZd60aea56567ae39a1b1920cbc42bb5bd');
$client = new Guanguans\Notify\XiZhi\Client($authenticator);

$response = $client->send(Guanguans\Notify\XiZhi\Messages\SingleMessage::make([
    'title' => 'This is title.',
    'content' => 'This is content.',
]));

$response = $client->send(Guanguans\Notify\XiZhi\Messages\ChannelMessage::make([
    'title' => 'This is title.',
    'content' => 'This is content.',
]));
```
