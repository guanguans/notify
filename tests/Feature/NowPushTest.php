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

class NowPushTest extends TestCase
{
    public function testNote()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        Factory::nowPush()
            ->setToken('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL')
            ->setMessage(new \Guanguans\Notify\Messages\NowPush\NoteMessage('This is a note.'))
            ->send();
    }

    public function testImage()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        Factory::nowPush()
            ->setToken('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL')
            ->setMessage(new \Guanguans\Notify\Messages\NowPush\ImageMessage('https://www.nowpush.app/assets/img/welcome/welcome-mockup.png'))
            ->send();
    }

    public function testLink()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        Factory::nowPush()
            ->setToken('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL')
            ->setMessage(new \Guanguans\Notify\Messages\NowPush\LinkMessage('https://github.com/guanguans/notify'))
            ->send();
    }

    public function testGetUser()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        Factory::nowPush()
            ->setToken('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL')
            ->getUser();
    }
}
