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
use Guanguans\Notify\Clients\GitterClient;
use Guanguans\Notify\Clients\GoogleChatClient;
use Guanguans\Notify\Clients\LoggerClient;
use Guanguans\Notify\Clients\MailerClient;
use Guanguans\Notify\Clients\MattermostClient;
use Guanguans\Notify\Clients\RocketChatClient;
use Guanguans\Notify\Clients\ServerChanClient;
use Guanguans\Notify\Clients\WeWorkClient;
use Guanguans\Notify\Clients\XiZhiClient;
use Guanguans\Notify\Clients\ZulipClient;
use Guanguans\Notify\Factory;

class FactoryTest extends TestCase
{
    public function testFactory(): void
    {
        $this->assertInstanceOf(BarkClient::class, Factory::bark());
        $this->assertInstanceOf(ChanifyClient::class, Factory::chanify());
        $this->assertInstanceOf(DingTalkClient::class, Factory::dingTalk());
        $this->assertInstanceOf(FeiShuClient::class, Factory::feiShu());
        $this->assertInstanceOf(GitterClient::class, Factory::gitter());
        $this->assertInstanceOf(GoogleChatClient::class, Factory::googleChat());
        $this->assertInstanceOf(LoggerClient::class, Factory::logger());
        $this->assertInstanceOf(MailerClient::class, Factory::mailer());
        $this->assertInstanceOf(MattermostClient::class, Factory::mattermost());
        $this->assertInstanceOf(RocketChatClient::class, Factory::rocketChat());
        $this->assertInstanceOf(ServerChanClient::class, Factory::serverChan());
        $this->assertInstanceOf(WeWorkClient::class, Factory::weWork());
        $this->assertInstanceOf(XiZhiClient::class, Factory::xiZhi());
        $this->assertInstanceOf(ZulipClient::class, Factory::zulip());
    }
}
