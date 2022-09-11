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
use Guanguans\Notify\Messages\FeiShu\CardMessage;
use Guanguans\Notify\Messages\FeiShu\ImageMessage;
use Guanguans\Notify\Messages\FeiShu\PostMessage;
use Guanguans\Notify\Messages\FeiShu\ShareChatMessage;
use Guanguans\Notify\Messages\FeiShu\TextMessage;
use Guanguans\Notify\Tests\TestCase;

class FeiShuTest extends TestCase
{
    public function testText(): void
    {
        $this->expectOutputString('19001');

        $ret = Factory::feiShu()
            ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
            ->setSecret('iigDOvnsIn6aFS1pYHHEH')
            ->setMessage(new TextMessage('This is title(keyword).'))
            ->send();

        echo $ret['code'];
    }

    public function testPost(): void
    {
        $post = null;
        $ret = [];
        $this->markTestSkipped(self::class.' is skipped.');

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
            ->setMessage(new PostMessage($post))
            ->send();

        echo $ret['code'];
    }

    public function testShareChat(): void
    {
        $ret = [];
        $this->markTestSkipped(self::class.' is skipped.');

        $this->expectOutputString('19001');

        $ret = Factory::feiShu()
            ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
            ->setSecret('iigDOvnsIn6aFS1pYHHE')
            ->setMessage(new ShareChatMessage('oc_f5b1a7eb27ae2c7b6adc2a74fafxxxxx'))
            ->send();

        echo $ret['code'];
    }

    public function testImage(): void
    {
        $ret = [];
        $this->markTestSkipped(self::class.' is skipped.');

        $this->expectOutputString('19001');

        $ret = Factory::feiShu()
            ->setToken('b6eb70d9-6e19-4f87-af48-348b028186')
            ->setSecret('iigDOvnsIn6aFS1pYHHE')
            ->setMessage(new ImageMessage('img_ecffc3b9-8f14-400f-a014-05eca1a4xxxx'))
            ->send();

        echo $ret['code'];
    }

    public function testCard(): void
    {
        $card = null;
        $ret = [];
        $this->markTestSkipped(self::class.' is skipped.');

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
            ->setMessage(new CardMessage($card))
            ->send();

        echo $ret['code'];
    }
}
