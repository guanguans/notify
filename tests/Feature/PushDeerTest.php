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

class PushDeerTest extends TestCase
{
    private $token = 'PDU5530TH1sn4HMhMdIJjc8pMxpIMPKnGMTJcgvX';

    public function testPushDeerNormal()
    {
        $ret = Factory::pushDeer()
            ->setToken($this->token)
            ->setMessage(new \Guanguans\Notify\Messages\PushDeerMessage('This is title.', 'This is desp. **normal**.', ''))
            ->send();

        $this->assertNotEquals(0, count($ret['content']['result']));
    }

    public function testPushDeerMarkdown()
    {
        $markdown = "## What's Changed

- Bump dependabot/fetch-metadata from 1.2.0 to 1.2.1 by @dependabot in https://github.com/guanguans/notify/pull/7
- Bump dependabot/fetch-metadata from 1.2.1 to 1.3.0 by @dependabot in https://github.com/guanguans/notify/pull/9
- Bump actions/checkout from 2 to 3 by @dependabot in https://github.com/guanguans/notify/pull/8";

        $ret = Factory::pushDeer()
            ->setToken('PDU5530TCmH0SgCFIqjPtIhYpSXXUso1BwEdR5ak')
            ->setMessage(new \Guanguans\Notify\Messages\PushDeerMessage('**This is title.**', $markdown, 'markdown'))
            ->send();

        $this->assertNotEquals(0, count($ret['content']['result']));
    }

    public function testPushDeerImage()
    {
        $ret = Factory::pushDeer()
            ->setToken($this->token)
            ->setMessage(new \Guanguans\Notify\Messages\PushDeerMessage('https://www.baidu.com/img/PCtm_d9c8750bed0b3c7d089fa7d55720d6cf.png', 'This is desp.', 'image'))
            ->send();

        $this->assertNotEquals(0, count($ret['content']['result']));
    }

    public function testPushDeerUrl()
    {
        $ret = Factory::pushDeer()
            ->setBaseUri('https://api2.pushdeer.com')
            ->setToken($this->token)
            ->setMessage(new \Guanguans\Notify\Messages\PushDeerMessage('This is title.', 'This is desp. **Custom URL**.', ''))
            ->send();

        $this->assertNotEquals(0, count($ret['content']['result']));
    }
}
