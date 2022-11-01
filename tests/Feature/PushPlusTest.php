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
use Guanguans\Notify\Messages\PushPlusMessage;
use Guanguans\Notify\Tests\TestCase;
use GuzzleHttp\Exception\ClientException;

class PushPlusTest extends TestCase
{
    public function testPushPlus(): void
    {
        $this->markTestSkipped(__CLASS__.' is skipped.');

        $this->expectException(ClientException::class);

        $ret = Factory::pushPlus()
            ->setToken('762e3f7efd764ad5acaa9cc26ac20')
            ->setMessage(new PushPlusMessage([
                'content' => 'This is content.',
                // 'title' => 'This is title.',
                // 'template' => 'html',
                // 'topic' => 'topic',
            ]))
            ->send();

        $this->assertNotSame(200, $ret['code']);
    }
}
