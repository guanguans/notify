# XiZhi

## Usage

```php
<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Guanguans\Notify\XiZhi\Client;
use Guanguans\Notify\XiZhi\Credential;
use Guanguans\Notify\XiZhi\Messages\ChannelMessage;
use Guanguans\Notify\XiZhi\Messages\SingleMessage;

require __DIR__.'/vendor/autoload.php';

$credential = new Credential('XZd60aea56567ae39a1b1920cbc42bb');
$client = new Client($credential);

$client->send(SingleMessage::make([
    'title' => 'This is title.',
    'content' => 'This is content.',
]));

$client->send(ChannelMessage::make([
    'title' => 'This is title.',
    'content' => 'This is content.',
]));
```
