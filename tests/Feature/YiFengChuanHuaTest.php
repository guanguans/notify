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

class YiFengChuanHuaTest extends TestCase
{
    public function testYiFengChuanHua()
    {
        // $this->markTestSkipped(__CLASS__.' is skipped.');

        $ret = Factory::yiFengChuanHua()
            ->setToken('204dd77ce4a6f221')
            ->setMessage(new \Guanguans\Notify\Messages\YiFengChuanHuaMessage([
                'head' => 'This is title.',
                'body' => 'This is content.',
            ]))
            ->send();

        $this->assertIsArray($ret);
        $this->assertGreaterThan(0, $ret['code']);
        $this->assertArrayHasKey('code', $ret);
        $this->assertArrayHasKey('message', $ret);
        $this->assertArrayHasKey('data', $ret);
    }
}
