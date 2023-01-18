<?php

declare(strict_types=1);

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
use Guanguans\Notify\Clients\DiscordClient;
use Guanguans\Notify\Clients\FeiShuClient;
use Guanguans\Notify\Clients\GitterClient;
use Guanguans\Notify\Clients\GoogleChatClient;
use Guanguans\Notify\Clients\IGotClient;
use Guanguans\Notify\Clients\LoggerClient;
use Guanguans\Notify\Clients\MailerClient;
use Guanguans\Notify\Clients\MattermostClient;
use Guanguans\Notify\Clients\MicrosoftTeamsClient;
use Guanguans\Notify\Clients\NowPushClient;
use Guanguans\Notify\Clients\NtfyClient;
use Guanguans\Notify\Clients\PushBackClient;
use Guanguans\Notify\Clients\PushClient;
use Guanguans\Notify\Clients\PushDeerClient;
use Guanguans\Notify\Clients\PushoverClient;
use Guanguans\Notify\Clients\PushPlusClient;
use Guanguans\Notify\Clients\QqChannelBotClient;
use Guanguans\Notify\Clients\RocketChatClient;
use Guanguans\Notify\Clients\ServerChanClient;
use Guanguans\Notify\Clients\ShowdocPushClient;
use Guanguans\Notify\Clients\SlackClient;
use Guanguans\Notify\Clients\TelegramClient;
use Guanguans\Notify\Clients\WebhookClient;
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
        $this->assertInstanceOf(DiscordClient::class, Factory::discord());
        $this->assertInstanceOf(FeiShuClient::class, Factory::feiShu());
        $this->assertInstanceOf(GitterClient::class, Factory::gitter());
        $this->assertInstanceOf(GoogleChatClient::class, Factory::googleChat());
        $this->assertInstanceOf(IGotClient::class, Factory::iGot());
        $this->assertInstanceOf(LoggerClient::class, Factory::logger());
        $this->assertInstanceOf(MailerClient::class, Factory::mailer());
        $this->assertInstanceOf(MattermostClient::class, Factory::mattermost());
        $this->assertInstanceOf(MicrosoftTeamsClient::class, Factory::microsoftTeams());
        $this->assertInstanceOf(NowPushClient::class, Factory::nowPush());
        $this->assertInstanceOf(NtfyClient::class, Factory::ntfy());
        $this->assertInstanceOf(PushBackClient::class, Factory::pushBack());
        $this->assertInstanceOf(PushClient::class, Factory::push());
        $this->assertInstanceOf(PushDeerClient::class, Factory::pushDeer());
        $this->assertInstanceOf(PushoverClient::class, Factory::pushover());
        $this->assertInstanceOf(PushPlusClient::class, Factory::pushPlus());
        $this->assertInstanceOf(QqChannelBotClient::class, Factory::qqChannelBot());
        $this->assertInstanceOf(RocketChatClient::class, Factory::rocketChat());
        $this->assertInstanceOf(ServerChanClient::class, Factory::serverChan());
        $this->assertInstanceOf(ShowdocPushClient::class, Factory::showdocPush());
        $this->assertInstanceOf(TelegramClient::class, Factory::telegram());
        $this->assertInstanceOf(SlackClient::class, Factory::slack());
        $this->assertInstanceOf(WebhookClient::class, Factory::webhook());
        $this->assertInstanceOf(WeWorkClient::class, Factory::weWork());
        $this->assertInstanceOf(XiZhiClient::class, Factory::xiZhi());
        $this->assertInstanceOf(ZulipClient::class, Factory::zulip());
    }
}
