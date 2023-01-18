<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Tests\Feature;

use Guanguans\Notify\Factory;
use Guanguans\Notify\Messages\NtfyMessage;
use Guanguans\Notify\Tests\TestCase;
use GuzzleHttp\Exception\ClientException;

class NtfyTest extends TestCase
{
    public function testNtfy(): void
    {
        $this->expectException(ClientException::class);

        $ntfyMessage = new NtfyMessage([
            'topic' => 'guanguans',
            'message' => 'This is message.',
            'title' => 'This is title.',
            'priority' => 1,
            'tags' => ['tag1', 'tag2'],
            'click' => 'https://example.com',
            'attach' => 'This is attach',
            'icon' => 'https://www.guanguans.cn',
            'filename' => 'file.jpg',
            'cache' => 'no',
            'firebase' => 'no',
            'actions' => [],
            // 'delay' => '30min, 9am',
            // 'email' => 'xxx@qq.com',
        ]);

        $ntfyMessage
            ->addAction([
                'action' => 'broadcast',
                'label' => 'This is label.',
                'intent' => 'This is intent.',
                'extras' => [
                    'field' => 'value',
                ],
            ])
            ->addAction([
                'action' => 'http',
                'label' => 'This is label.',
                'url' => 'https://www.guanguans.cn',
                'method' => 'POST',
                'headers' => [
                    'Authorization' => 'Bearer ...',
                ],
                'body' => '{"field":"value"}',
            ])
            ->addAction([
                'action' => 'view',
                'label' => 'This is label.',
                'url' => 'https://www.guanguans.cn',
                'clear' => true,
            ]);

        Factory::ntfy()
            // ->setBaseUri('The server address of your own deployment.')
            // ->setUsername('username')
            // ->setPassword('password')
            ->setMessage($ntfyMessage)
            ->send();
    }
}
