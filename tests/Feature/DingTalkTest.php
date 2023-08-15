<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Tests\Feature;

use Guanguans\Notify\Factory;
use Guanguans\Notify\Messages\DingTalk\BtnsActionCardMessage;
use Guanguans\Notify\Messages\DingTalk\FeedCardMessage;
use Guanguans\Notify\Messages\DingTalk\LinkMessage;
use Guanguans\Notify\Messages\DingTalk\MarkdownMessage;
use Guanguans\Notify\Messages\DingTalk\SingleActionCardMessage;
use Guanguans\Notify\Messages\DingTalk\TextMessage;
use Guanguans\Notify\Tests\TestCase;

class DingTalkTest extends TestCase
{
    public function testText(): void
    {
        $this->expectOutputRegex('/^300001|300005|130101$/');

        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
            ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee517')
            ->setMessage(new TextMessage([
                'content' => 'This is content(keyword).',
                // 'atMobiles' => [13948484984],
                // 'atDingtalkIds' => [123456],
                // 'isAtAll'   => false,
            ]))
            ->send();

        echo $ret['errcode'];
    }

    public function testLink(): void
    {
        $this->expectOutputRegex('/^300001|300005|130101$/');

        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
            ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee517')
            ->setMessage(new LinkMessage([
                'title' => 'This is content.',
                'text' => 'This is text(keyword).',
                'messageUrl' => 'https://github.com/guanguans/notify',
                'picUrl' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
            ]))
            ->send();

        echo $ret['errcode'];
    }

    public function testMarkdown(): void
    {
        $this->expectOutputRegex('/^300001|300005|130101$/');

        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
            ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee517')
            ->setMessage(new MarkdownMessage([
                'title' => 'This is title.',
                'text' => '> This is text(keyword).',
                // 'atMobiles' => [13948484984],
                // 'atDingtalkIds' => [123456],
                // 'isAtAll'   => false,
            ]))
            ->send();

        echo $ret['errcode'];
    }

    public function testSingleActionCard(): void
    {
        $this->expectOutputRegex('/^300001|300005|130101$/');

        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
            ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee517')
            ->setMessage(new SingleActionCardMessage([
                'title' => 'This is title(keyword).',
                'text' => 'This is text.',
                'singleTitle' => 'This is singleTitle.',
                'singleURL' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                // 'btnOrientation' => 1
            ]))
            ->send();

        echo $ret['errcode'];
    }

    public function testBtnsActionCard(): void
    {
        $this->expectOutputRegex('/^300001|300005|130101$/');

        $btnsActionCardMessage = new BtnsActionCardMessage([
            'title' => 'This is title(keyword).',
            'text' => 'This is text.',
            // 'hideAvatar'     => 1,
            // 'btnOrientation' => 1,
        ]);
        $btnsActionCardMessage->addBtn([
            'title' => 'This is title 1',
            'actionURL' => 'https://github.com/guanguans/notify',
        ]);
        $btnsActionCardMessage->addBtn([
            'title' => 'This is title 2',
            'actionURL' => 'https://github.com/guanguans/notify',
        ]);
        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
            ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee517')
            ->setMessage($btnsActionCardMessage)
            ->send();

        echo $ret['errcode'];
    }

    public function testFeedCard(): void
    {
        $this->expectOutputRegex('/^300001|300005|130101$/');

        $feedCardMessage = new FeedCardMessage([
            'title' => 'This is title(keyword) 0.',
            'messageURL' => 'https://github.com/guanguans/notify',
            'picURL' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        ]);
        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
            ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee517')
            ->setMessage($feedCardMessage)
            ->send();

        echo $ret['errcode'];
    }
}
