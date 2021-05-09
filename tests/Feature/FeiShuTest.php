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

class FeiShuTest extends TestCase
{
    public function testText()
    {
        $this->expectOutputString('19001');

        $ret = Factory::feiShu()
            ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
            ->setMessage((new \Guanguans\Notify\Messages\FeiShu\TextMessage([
                'text' => 'crm text',
                'secret' => 'NHBmRmgkd8Ir3jfScH84',
            ])))
            ->send();

        echo $ret['code'];
    }

    public function testPost()
    {
        $this->expectOutputString('19001');

        $ret = Factory::feiShu()
            ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
            ->setMessage((new \Guanguans\Notify\Messages\FeiShu\PostMessage([
                'post' => [],
                'secret' => 'NHBmRmgkd8Ir3jfScH84',
            ])))
            ->send();

        echo $ret['code'];
    }

    public function testInteractive()
    {
        $this->expectOutputString('19001');

        $ret = Factory::feiShu()
            ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
            ->setMessage((new \Guanguans\Notify\Messages\FeiShu\InteractiveMessage([
                'card' => [],
                'secret' => 'NHBmRmgkd8Ir3jfScH84',
            ])))
            ->send();

        echo $ret['code'];
    }

    public function testShareChat()
    {
        $this->expectOutputString('19001');

        $ret = Factory::feiShu()
            ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
            ->setMessage((new \Guanguans\Notify\Messages\FeiShu\ShareChatMessage([
                'share_chat_id' => 'share_chat_id',
                'secret' => 'NHBmRmgkd8Ir3jfScH84',
            ])))
            ->send();

        echo $ret['code'];
    }

    public function testImage()
    {
        $this->expectOutputString('19001');

        $ret = Factory::feiShu()
            ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
            ->setMessage((new \Guanguans\Notify\Messages\FeiShu\ImageMessage([
                'image_key' => 'image_key',
                'secret' => 'NHBmRmgkd8Ir3jfScH84',
            ])))
            ->send();

        echo $ret['code'];
    }
}
