<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\NotifyTests\Feature;

use Guanguans\Notify\Factory;
use Guanguans\Notify\Messages\WeWork\ImageMessage;
use Guanguans\Notify\Messages\WeWork\MarkdownMessage;
use Guanguans\Notify\Messages\WeWork\NewsMessage;
use Guanguans\Notify\Messages\WeWork\TextMessage;
use Guanguans\NotifyTests\TestCase;

class WeWorkTest extends TestCase
{
    public function testText(): void
    {
        $this->expectOutputString('93000');

        $ret = Factory::weWork()
            ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778f')
            ->setMessage(new TextMessage([
                'content' => 'This is content.',
                // 'mentioned_list'        => ["wangqing", "@all"],
                // 'mentioned_mobile_list' => ["13800001111", "@all"],
            ]))
            ->send();

        echo $ret['errcode'];
    }

    public function testMarkdown(): void
    {
        $this->expectOutputString('93000');

        $ret = Factory::weWork()
            ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778')
            ->setMessage(new MarkdownMessage("# This is title.\n This is content."))
            ->send();

        echo $ret['errcode'];
    }

    public function testImage(): void
    {
        $this->expectOutputString('93000');

        $ret = Factory::weWork()
            ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778')
            ->setMessage(new ImageMessage('https://avatars.githubusercontent.com/u/22309277?v=4'))
            ->send();

        echo $ret['errcode'];
    }

    public function testNews(): void
    {
        $this->expectOutputString('93000');

        $newsMessage = new NewsMessage([
            'title' => 'This is title1.',
            'description' => 'This is description.',
            'url' => 'https://github.com/guanguans/notify',
            'picurl' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        ]);
        $newsMessage->addArticle([
            'title' => 'This is title2.',
            'description' => 'This is description.',
            'url' => 'https://github.com/guanguans/notify',
            'picurl' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        ]);
        $ret = Factory::weWork()
            ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778f')
            ->setMessage($newsMessage)
            ->send();

        echo $ret['errcode'];
    }
}
