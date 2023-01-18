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
use Guanguans\Notify\Messages\RocketChatMessage;
use Guanguans\Notify\Tests\TestCase;
use GuzzleHttp\Exception\ClientException;

class RocketChatTest extends TestCase
{
    public function testRocketChat(): void
    {
        $this->expectException(ClientException::class);

        $ret = Factory::rocketChat()
            ->setToken('EemSHx9ioqdmrWouS/yYpmhqDSyd7CqmSAnyBfKezLyzotswbRSpkD9MCNxqtPL')
            ->setBaseUri('https://guanguans.rocket.chat')
            ->setMessage(
                new RocketChatMessage([
                    'alias' => '报警机器人',
                    'emoji' => ':warning:',
                    'text' => 'This is a testing. ',
                    'attachments' => [
                        [
                            'title' => 'This is a title.',
                            'title_link' => 'https://rocket.chat',
                            'text' => 'This is a text.',
                            'image_url' => 'http://www.xxx.png',
                            'color' => '#764FA5',
                        ],
                    ],
                ])
            )
            ->send();

        $this->assertIsArray($ret);
        $this->assertEmpty($ret);
    }
}
