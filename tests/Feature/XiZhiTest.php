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
    public function testXiZhi()
    {
        $this->expectOutputString('用户不存在');

        $ret = Factory::xiZhi()
            ->setToken('XZd60aea56567ae39a1b1920cbc42bb')
            ->setMessage((new \Guanguans\Notify\Messages\XiZhiMessage([
                'title' => 'title',
                'content' => 'content',
            ])))
            ->send();

        echo $ret['msg'];
    }
}
