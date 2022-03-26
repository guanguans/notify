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
            ->setSecret('iigDOvnsIn6aFS1pYHHEH')
            ->setMessage(new \Guanguans\Notify\Messages\FeiShu\TextMessage('This is title(keyword).'))
            ->send();

        echo $ret['code'];
    }

    public function testPost()
    {
        $this->markTestSkipped(__CLASS__.' is skipped.');

        $this->expectOutputString('19001');

        $post = [
            'zh_cn' => [
                'title' => '项目更新通知',
                'content' => [
                    [
                        [
                            'tag' => 'text',
                            'text' => '项目有更新(keyword)',
                        ],
                    ],
                ],
            ],
        ];
        $ret = Factory::feiShu()
            ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
            ->setSecret('iigDOvnsIn6aFS1pYHHEH')
            ->setMessage(new \Guanguans\Notify\Messages\FeiShu\PostMessage($post))
            ->send();

        echo $ret['code'];
    }

    public function testShareChat()
    {
        $this->markTestSkipped(__CLASS__.' is skipped.');

        $this->expectOutputString('19001');

        $ret = Factory::feiShu()
            ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
            ->setSecret('iigDOvnsIn6aFS1pYHHE')
            ->setMessage(new \Guanguans\Notify\Messages\FeiShu\ShareChatMessage('oc_f5b1a7eb27ae2c7b6adc2a74fafxxxxx'))
            ->send();

        echo $ret['code'];
    }

    public function testImage()
    {
        $this->markTestSkipped(__CLASS__.' is skipped.');

        $this->expectOutputString('19001');

        $ret = Factory::feiShu()
            ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
            ->setSecret('iigDOvnsIn6aFS1pYHHE')
            ->setMessage(new \Guanguans\Notify\Messages\FeiShu\ImageMessage('img_ecffc3b9-8f14-400f-a014-05eca1a4xxxx'))
            ->send();

        echo $ret['code'];
    }

    public function testCard()
    {
        $this->markTestSkipped(__CLASS__.' is skipped.');

        $this->expectOutputString('19001');

        $card = [
            'elements' => [
                [
                    'tag' => 'div',
                    'text' => [
                        'content' => '**西湖(keyword)**，位于浙江省杭州市西湖区龙井路1号，杭州市区西部，景区总面积49平方千米，汇水面积为21.22平方千米，湖面面积为6.38平方千米。',
                        'tag' => 'lark_md',
                    ],
                ],
            ],
        ];
        $ret = Factory::feiShu()
            ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
            ->setSecret('iigDOvnsIn6aFS1pYHHE')
            ->setMessage(new \Guanguans\Notify\Messages\FeiShu\CardMessage($card))
            ->send();

        echo $ret['code'];
    }
}
