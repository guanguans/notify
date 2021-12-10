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

class GoogleChatTest extends TestCase
{
    public function testGoogleChat()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        $this->markTestSkipped(__METHOD__.' is skipped.');

        Factory::googleChat()
            ->setToken('accessToken')
            ->setKey('accessKey')
            ->setSpace('space')
            // ->setThreadKey('threadKey')
            ->setMessage(
                new \Guanguans\Notify\Messages\GoogleChatMessage([
                    'text' => 'This is a testing.',
                ])
            )
            ->send();
    }
}
