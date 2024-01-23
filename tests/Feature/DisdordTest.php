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
use Guanguans\Notify\Messages\DiscordMessage;
use Guanguans\NotifyTests\TestCase;
use GuzzleHttp\Exception\ClientException;

class DisdordTest extends TestCase
{
    public function testDisdord(): void
    {
        $this->markTestSkipped(self::class.' is skipped.');

        new DiscordMessage([
            'content' => 'This is content.',
            'username' => 'notify bot.',
            'avatar_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
            'tts' => false,
            'embeds' => $embed = [
                'title' => 'This is title.',
                'type' => 'This is type.',
                'description' => 'This is description.',
                'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                'color' => '0365D6',
                'footer' => [
                    'text' => 'This is text.',
                    'icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                ],
                'image' => [
                    'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                ],
                'thumbnail' => [
                    'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                ],
                'author' => [
                    'name' => 'This is name.',
                    'url' => 'https://avatars.githubusercontent.com/u/22309277?v=4.',
                    'icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
                ],
                'fields' => [
                    [
                        'name' => 'This is name.',
                        'value' => 'This is value.',
                        'inline' => false,
                    ],
                ],
            ],
        ]);

        $this->expectException(ClientException::class);

        Factory::discord()
            ->setWebhookUrl('https://discord.com/api/webhooks/955407924304425000/o7RfCGxek_o8kfR6Q9iGKtTdRJ')
            ->setMessage($message->addEmbed($embed))
            ->send();
    }
}
