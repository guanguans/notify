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

class ServerChanTest extends TestCase
{
    public function testSendMessage()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        Factory::serverChan()
            ->setToken('SCT35149Thtf1g2Bc14QJuQ6HFpW5Y')
            ->setMessage(new \Guanguans\Notify\Messages\ServerChanMessage('This is title.', 'This is desp.'))
            ->send();
    }

    public function testCheckMessage()
    {
        $ret = Factory::serverChan()->check(333484, 'SCTJlJV1J87hS6F');

        $this->assertNull($ret['data']);
    }
}
