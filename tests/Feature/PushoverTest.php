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
use Guanguans\Notify\Messages\PushoverMessage;
use Guanguans\NotifyTests\TestCase;
use GuzzleHttp\Exception\ClientException;

/**
 * @internal
 *
 * @small
 */
class PushoverTest extends TestCase
{
    public function testPushover(): void
    {
        $this->expectException(ClientException::class);

        $pushoverMessage = new PushoverMessage([
            'message' => 'This is message.',
            // 'title' => 'This is title.',
            // 'timestamp' => time(),
            // 'priority' => 2,
            // 'url' => 'https://www.guanguans.cn',
            // 'url_title' => 'This is URL title.',
            // 'sound' => 'bike',
            // 'retry' => 60,
            // 'expire' => 3600,
            // 'html' => 1,
            // 'monospace' => 0,
            // 'callback' => 'https://www.guanguans.cn/',
            // 'device' => 'iphone',
            // 'attachment' => '/Users/yaozm/Downloads/xxx.png',
        ]);

        Factory::pushover()
            ->setToken('abs9tevjnpu2p7x1yii8uf23')
            ->setUserToken('uz86ivgu7xkizpdpdo65vw2c')
            ->setMessage($pushoverMessage)
            ->send();
    }

    public function testValidateUser(): void
    {
        $this->expectException(ClientException::class);

        Factory::pushover()
            ->setToken('abs9tevjnpu2p7x1yii8uf23')
            ->setUserToken('uz86ivgu7xkizpdpdo65vw2c')
            ->validateUser();
    }

    public function testSounds(): void
    {
        $this->expectException(ClientException::class);

        Factory::pushover()
            ->setToken('abs9tevjnpu2p7x1yii8uf23')
            ->sounds();
    }
}
