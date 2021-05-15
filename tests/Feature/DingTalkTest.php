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

class DingTalkTest extends TestCase
{
    public function testText()
    {
        $this->expectOutputString('300001');

        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
            ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee517')
            ->setMessage((new \Guanguans\Notify\Messages\DingTalk\TextMessage([
                'content' => 'This is content(keyword).',
                // 'atMobiles' => [13948484984],
                // 'atUserIds' => [123456],
                // 'isAtAll'   => false,
            ])))
            ->send();

        echo $ret['errcode'];
    }

    public function testLink()
    {
        $this->expectOutputString('300001');

        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
            ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee517')
            ->setMessage((new \Guanguans\Notify\Messages\DingTalk\LinkMessage([
                'title' => 'This is content.',
                'text' => 'This is text(keyword).',
                'messageUrl' => 'https://github.com/guanguans/notify',
                'picUrl' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
            ])))
            ->send();

        echo $ret['errcode'];
    }

    public function testMarkdown()
    {
        $this->expectOutputString('300001');

        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
            ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee517')
            ->setMessage((new \Guanguans\Notify\Messages\DingTalk\MarkdownMessage([
                'title' => 'This is title.',
                'text' => '> This is text(keyword).',
                // 'atMobiles' => [13948484984],
                // 'atUserIds' => [123456],
                // 'isAtAll'   => false,
            ])))
            ->send();

        echo $ret['errcode'];
    }

    public function testSingleActionCard()
    {
        $this->expectOutputString('300001');

        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
            ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee517')
            ->setMessage(new \Guanguans\Notify\Messages\DingTalk\SingleActionCardMessage([
                'title' => 'This is title(keyword).',
                'text' => 'This is text.',
                'singleTitle' => 'This is singleTitle.',
                'singleURL' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                // 'btnOrientation' => 1
            ]))
            ->send();

        echo $ret['errcode'];
    }

    public function testBtnsActionCard()
    {
        $this->expectOutputString('300001');

        $message = new \Guanguans\Notify\Messages\DingTalk\BtnsActionCardMessage([
            'title' => 'This is title(keyword).',
            'text' => 'This is text.',
            // 'hideAvatar'     => 1,
            // 'btnOrientation' => 1,
        ]);
        $message->addBtn([
            'title' => 'This is title 1',
            'actionURL' => 'https://github.com/guanguans/notify',
        ]);
        $message->addBtn([
            'title' => 'This is title 2',
            'actionURL' => 'https://github.com/guanguans/notify',
        ]);
        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
            ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee517')
            ->setMessage($message)
            ->send();

        echo $ret['errcode'];
    }

    public function testFeedCard()
    {
        $this->expectOutputString('300001');

        $message = new \Guanguans\Notify\Messages\DingTalk\FeedCardMessage([
            'title' => 'This is title(keyword) 0.',
            'messageURL' => 'https://github.com/guanguans/notify',
            'picURL' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        ]);
        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73e')
            ->setSecret('SECc32bb7345c0f73da2b9786f0f7dd5083bd768a29b82e6d460149d730eee517')
            ->setMessage($message)
            ->send();

        echo $ret['errcode'];
    }
}
