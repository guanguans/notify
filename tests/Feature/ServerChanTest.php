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
use Guanguans\Notify\Messages\ServerChanMessage;
use Guanguans\Notify\Tests\TestCase;
use GuzzleHttp\Exception\ClientException;

class ServerChanTest extends TestCase
{
    public function testSendMessage(): void
    {
        $this->expectException(ClientException::class);

        Factory::serverChan()
            ->setToken('SCT35149Thtf1g2Bc14QJuQ6HFpW5Y')
            ->setMessage(new ServerChanMessage('This is title.', 'This is desp.'))
            ->send();
    }

    public function testCheckMessage(): void
    {
        $ret = Factory::serverChan()->check(333484, 'SCTJlJV1J87hS6F');

        $this->assertNull($ret['data']);
    }
}
