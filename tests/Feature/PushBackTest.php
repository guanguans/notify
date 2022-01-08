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

class PushBackTest extends TestCase
{
    public function testPushBack()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        $this->markTestSkipped(__CLASS__.' is skipped.');

        Factory::pushBack()
            ->setToken('at_uDCCK8gdHJPN613lASV')
            // ->setSynchonousMode()
            ->setMessage(
                new \Guanguans\Notify\Messages\PushBackMessage([
                    'id' => 'User_1730',
                    'title' => 'This is title.',
                    // 'body' => 'This is body.',
                    // 'action1' => 'action1',
                    // 'action2' => 'action2',
                    // 'reply' => 'reply',
                ])
            )
            ->send();
    }
}
