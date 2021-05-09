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
            ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778')
            ->setMessage((new \Guanguans\Notify\Messages\WeWork\TextMessage([
                'content' => 'content',
            ])))
            ->send();

        echo $ret['errcode'];
    }

    public function testNews()
    {
        $this->expectOutputString('93000');

        $newsMessage = new \Guanguans\Notify\Messages\WeWork\NewsMessage();
        $newsMessage->setArticle([
            'title' => 'title',
            'description' => 'description',
            'url' => 'https://www.baidu.com',
            'picurl' => 'https://www.baidu.com',
        ]);

        $ret = Factory::weWork()
            ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778')
            ->setMessage($newsMessage)
            ->send();

        echo $ret['errcode'];
    }

    public function testMarkdown()
    {
        $this->expectOutputString('93000');

        $ret = Factory::weWork()
            ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778')
            ->setMessage((new \Guanguans\Notify\Messages\WeWork\MarkdownMessage([
                'content' => 'content',
            ])))
            ->send();

        echo $ret['errcode'];
    }

    public function testImage()
    {
        $this->expectOutputString('93000');

        $ret = Factory::weWork()
            ->setToken('73a3d5a3-ceff-4da8-bcf3-ff5891778')
            ->setMessage((new \Guanguans\Notify\Messages\WeWork\ImageMessage([
                'image_path' => 'https://upload-images.jianshu.io/upload_images/8889419-1a08be936dc39675.jpg?imageMogr2/auto-orient/strip|imageView2/2/w/1080/format/webp',
            ])))
            ->send();

        echo $ret['errcode'];
    }
}
