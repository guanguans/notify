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
use GuzzleHttp\Exception\ServerException;

class PushDeerTest extends TestCase
{
    public function testPushDeer()
    {
        $this->expectException(ServerException::class);

        $ret = Factory::pushDeer()
            ->setToken('PDU8024TTt9Yvx4wkm08SmSXAY9pnPycl5RrB')
            ->setMessage(new \Guanguans\Notify\Messages\PushDeerMessage('## This is text.', '> This is desp.', 'markdown'))
            ->send();

        $this->assertEmpty($ret['content']['result']);
    }
}
