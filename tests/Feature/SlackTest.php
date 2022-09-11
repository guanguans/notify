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
use Guanguans\Notify\Messages\SlackMessage;
use Guanguans\Notify\Tests\TestCase;
use GuzzleHttp\Exception\ClientException;

class SlackTest extends TestCase
{
    public function testSlack(): void
    {
        $slackMessage = new SlackMessage([
            'text' => 'This is text.',
            'channel' => '#general',
            'username' => 'notify bot',
            'icon_emoji' => ':ghost:',
            'icon_url' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
            'unfurl_links' => true,
            'attachments' => $attachment = [
                'fallback' => 'Required text summary of the attachment',
                'text' => 'Optional text that should appear within the attachment',
                'pretext' => 'Optional text that should appear above the formatted data',
                'color' => '#36a64f',
                'fields' => [
                    [
                        'title' => 'Required Field Title',
                        'value' => 'Text value of the field.',
                        'short' => false,
                    ],
                ],
            ],
        ]);

        $this->expectException(ClientException::class);

        Factory::slack()
            ->setWebhookUrl('https://hooks.slack.com/services/TPU9A98MT/B038KNUC0GY/6pKH3vfa3mjlUPcgLSjzR')
            ->setMessage($slackMessage->addAttachment($attachment))
            ->send();
    }
}
