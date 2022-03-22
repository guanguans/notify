<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Tests\Feature;

use Guanguans\Notify\Factory;
use Guanguans\Notify\Tests\TestCase;
use GuzzleHttp\Exception\ClientException;

class WebhookTest extends TestCase
{
    public function testWebhook()
    {
        $message = \Guanguans\Notify\Messages\WebhookMessage::create([
            'content' => 'This is content.',
            'username' => 'notify bot.',
        ])
        // ->setHeaders(['Accept' => '*/*'])
        // ->setQuery([['foo' => 'bar']])
        ->setVerify(false);

        $this->expectException(ClientException::class);

        Factory::webhook()
            ->setUrl('https://discord.com/api/webhooks/955407924304425000/o7RfCGxek_o8kfR6Q9iGKtTdRJ')
            // ->setRequestMethod('postJson')
            ->setMessage($message)
            ->send();
    }
}
