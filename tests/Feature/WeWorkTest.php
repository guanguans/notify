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

class WeWorkTest extends TestCase
{
    public function testText()
    {
        $this->expectOutputString('93000');

        $ret = Factory::weWork()
            ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778f')
            ->setMessage((new \Guanguans\Notify\Messages\WeWork\TextMessage([
                'content' => 'This is content.',
                // 'mentioned_list'        => ["wangqing", "@all"],
                // 'mentioned_mobile_list' => ["13800001111", "@all"],
            ])))
            ->send();

        echo $ret['errcode'];
    }

    public function testMarkdown()
    {
        $this->expectOutputString('93000');

        $ret = Factory::weWork()
            ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778')
            ->setMessage(new \Guanguans\Notify\Messages\WeWork\MarkdownMessage("# This is title.\n This is content."))
            ->send();

        echo $ret['errcode'];
    }

    public function testImage()
    {
        $this->expectOutputString('93000');

        $ret = Factory::weWork()
            ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778')
            ->setMessage(new \Guanguans\Notify\Messages\WeWork\ImageMessage('https://avatars.githubusercontent.com/u/22309277?v=4'))
            ->send();

        echo $ret['errcode'];
    }

    public function testNews()
    {
        $this->expectOutputString('93000');

        $message = new \Guanguans\Notify\Messages\WeWork\NewsMessage([
            'title' => 'This is title1.',
            'description' => 'This is description.',
            'url' => 'https://github.com/guanguans/notify',
            'picurl' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        ]);
        $message->addArticle([
            'title' => 'This is title2.',
            'description' => 'This is description.',
            'url' => 'https://github.com/guanguans/notify',
            'picurl' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        ]);
        $ret = Factory::weWork()
            ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778f')
            ->setMessage($message)
            ->send();

        echo $ret['errcode'];
    }
}
