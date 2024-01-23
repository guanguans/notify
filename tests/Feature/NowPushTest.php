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
use Guanguans\Notify\Messages\NowPush\ImageMessage;
use Guanguans\Notify\Messages\NowPush\LinkMessage;
use Guanguans\Notify\Messages\NowPush\NoteMessage;
use Guanguans\NotifyTests\TestCase;
use GuzzleHttp\Exception\ClientException;

class NowPushTest extends TestCase
{
    public function testNote(): void
    {
        $this->markTestSkipped(__METHOD__.' is skipped.');

        $this->expectException(ClientException::class);
        // $this->expectException(\GuzzleHttp\Exception\ServerException::class);

        Factory::nowPush()
            ->setToken('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL')
            ->setMessage(new NoteMessage('This is a note.'))
            ->send();
    }

    public function testImage(): void
    {
        $this->markTestSkipped(__METHOD__.' is skipped.');

        $this->expectException(ClientException::class);
        // $this->expectException(\GuzzleHttp\Exception\ServerException::class);

        Factory::nowPush()
            ->setToken('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL')
            ->setMessage(new ImageMessage('https://www.nowpush.app/assets/img/welcome/welcome-mockup.png'))
            ->send();
    }

    public function testLink(): void
    {
        $this->markTestSkipped(__METHOD__.' is skipped.');

        $this->expectException(ClientException::class);
        // $this->expectException(\GuzzleHttp\Exception\ServerException::class);

        Factory::nowPush()
            ->setToken('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL')
            ->setMessage(new LinkMessage('https://github.com/guanguans/notify'))
            ->send();
    }

    public function testGetUser(): void
    {
        $this->markTestSkipped(__METHOD__.' is skipped.');

        $this->expectException(ClientException::class);
        // $this->expectException(\GuzzleHttp\Exception\ServerException::class);

        Factory::nowPush()
            ->setToken('vpNVue4teSl93ijHBVT6sDT4sHLP7OMTzFCfdQb0QxLYvL')
            ->getUser();
    }
}
