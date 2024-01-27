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
use Guanguans\NotifyTests\TestCase;
use GuzzleHttp\Exception\ClientException;

/**
 * @internal
 *
 * @small
 */
class QqChannelBotTest extends TestCase
{
    public function testQqChannelBot(): void
    {
        $this->markTestSkipped(self::class.' is skipped.');

        $this->expectException(ClientException::class);

        Factory::qqChannelBot()
            ->setAppid(102001)
            ->setToken('eghXYBXQH0QXBByb8Zj4VeRGterQG')
            ->setChannelId('4317')
            // ->sandboxEnvironment()
            // ->setSecret('3yfBSaUCfy3zlQr5')
            ->setMessage(\Guanguans\Notify\Messages\QqChannelBotMessage::create([
                'content' => 'This is content.',
                'image' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                // 'msg_id' => '3yfBSa',
                // 'embed' => [],
                // 'ark' => [],
                // 'message_reference' => [],
                // 'markdown' => [],
            ]))
            ->send();
    }
}
