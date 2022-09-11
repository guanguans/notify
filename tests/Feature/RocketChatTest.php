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

class RocketChatTest extends TestCase
{
    public function testRocketChat()
    {
        // $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        $ret = Factory::rocketChat()
            ->setToken('EemSHx9ioqdmrWouS/yYpmhqDSyd7CqmSAnyBfKezLyzotswbRSpkD9MCNxqtPL')
            ->setBaseUri('https://guanguans.rocket.chat')
            ->setMessage(
                new \Guanguans\Notify\Messages\RocketChatMessage([
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
