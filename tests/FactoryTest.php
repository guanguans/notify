<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Tests;

use Guanguans\Notify\Clients\BarkClient;
use Guanguans\Notify\Clients\ChanifyClient;
use Guanguans\Notify\Clients\DingTalkClient;
use Guanguans\Notify\Clients\FeiShuClient;
use Guanguans\Notify\Clients\ServerChanClient;
use Guanguans\Notify\Clients\WeWorkClient;
use Guanguans\Notify\Clients\XiZhiClient;
use Guanguans\Notify\Factory;

class FactoryTest extends TestCase
{
    public function testFactory()
    {
        $this->assertInstanceOf(BarkClient::class, Factory::bark());
        $this->assertInstanceOf(ChanifyClient::class, Factory::chanify());
        $this->assertInstanceOf(DingTalkClient::class, Factory::dingTalk());
        $this->assertInstanceOf(FeiShuClient::class, Factory::feiShu());
        $this->assertInstanceOf(ServerChanClient::class, Factory::serverChan());
        $this->assertInstanceOf(WeWorkClient::class, Factory::weWork());
        $this->assertInstanceOf(XiZhiClient::class, Factory::xiZhi());
    }
}
