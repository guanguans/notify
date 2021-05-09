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
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73')
            ->setMessage((new \Guanguans\Notify\Messages\DingTalk\TextMessage([
                'content' => 'crm content',
                'secret' => 'SEC3cd6abd8b0a395b8baa6bdf3c34d7216b54f9d6bc6875655eee3e4c3e7d6',
            ])))
            ->send();

        echo $ret['errcode'];
    }

    public function testMarkdown()
    {
        $this->expectOutputString('300001');

        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73')
            ->setMessage((new \Guanguans\Notify\Messages\DingTalk\MarkdownMessage([
                'title' => 'crm title',
                'secret' => 'SEC3cd6abd8b0a395b8baa6bdf3c34d7216b54f9d6bc6875655eee3e4c3e7d6',
            ])))
            ->send();

        echo $ret['errcode'];
    }

    public function testLink()
    {
        $this->expectOutputString('300001');

        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73')
            ->setMessage((new \Guanguans\Notify\Messages\DingTalk\LinkMessage([
                'title' => 'crm title',
                'secret' => 'SEC3cd6abd8b0a395b8baa6bdf3c34d7216b54f9d6bc6875655eee3e4c3e7d6',
            ])))
            ->send();

        echo $ret['errcode'];
    }

    public function testActionCard()
    {
        $this->expectOutputString('300001');

        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73')
            ->setMessage((new \Guanguans\Notify\Messages\DingTalk\ActionCardMessage([
                'title' => 'crm title',
                'secret' => 'SEC3cd6abd8b0a395b8baa6bdf3c34d7216b54f9d6bc6875655eee3e4c3e7d6',
            ])))
            ->send();

        echo $ret['errcode'];
    }

    public function testFeedCard()
    {
        $this->expectOutputString('300001');

        $ret = Factory::dingTalk()
            ->setToken('c44fec1ddaa8a833156efb77b7865d62ae13775418030d94d05da08bfca73')
            ->setMessage((new \Guanguans\Notify\Messages\DingTalk\FeedCardMessage([
                'links' => [],
                'secret' => 'SEC3cd6abd8b0a395b8baa6bdf3c34d7216b54f9d6bc6875655eee3e4c3e7d6',
            ])))
            ->send();

        echo $ret['errcode'];
    }
}
