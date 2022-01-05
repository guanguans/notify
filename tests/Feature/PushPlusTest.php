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

class PushPlusTest extends TestCase
{
    public function testPushPlus()
    {
        $this->markTestSkipped(__CLASS__.' is skipped.');

        $ret = Factory::pushPlus()
            ->setToken('762e3f7efd764ad5acaa9cc26ac20')
            ->setMessage(new \Guanguans\Notify\Messages\PushPlusMessage([
                'content' => 'This is content.',
                // 'title' => 'This is title.',
                // 'template' => 'html',
                // 'topic' => 'topic',
            ]))
            ->send();

        $this->assertNotEquals(200, $ret['code']);
    }
}
