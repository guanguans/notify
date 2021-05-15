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

class XiZhiTest extends TestCase
{
    public function testSingle()
    {
        $this->expectOutputString('用户不存在');

        $ret = Factory::xiZhi()
            // ->setType('single')
            ->setToken('XZd60aea56567ae39a1b1920cbc42bb')
            ->setMessage(new \Guanguans\Notify\Messages\XiZhiMessage('This is title.', 'This is content.'))
            ->send();

        echo $ret['msg'];
    }

    public function testChannel()
    {
        $this->expectOutputString('未知错误');

        $ret = Factory::xiZhi()
            ->setType('channel')
            ->setToken('XZ8da15b55a6725497232d87298bcd3')
            ->setMessage(new \Guanguans\Notify\Messages\XiZhiMessage('This is title.', 'This is content.'))
            ->send();

        echo $ret['msg'];
    }
}
