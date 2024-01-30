# XiZhi

## Usage

```php
$credential = new Guanguans\Notify\XiZhi\Credential('XZd60aea56567ae39a1b1920cbc42bb5bd');
$client = new Guanguans\Notify\XiZhi\Client($credential);

$response = $client->send(Guanguans\Notify\XiZhi\Messages\SingleMessage::make([
    'title' => 'This is title.',
    'content' => 'This is content.',
]));

$response = $client->send(Guanguans\Notify\XiZhi\Messages\ChannelMessage::make([
    'title' => 'This is title.',
    'content' => 'This is content.',
]));
```
