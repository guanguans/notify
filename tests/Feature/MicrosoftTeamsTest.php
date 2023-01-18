<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Tests\Feature;

use Guanguans\Notify\Factory;
use Guanguans\Notify\Messages\MicrosoftTeamsMessage;
use Guanguans\Notify\Tests\TestCase;
use GuzzleHttp\Exception\ClientException;

class MicrosoftTeamsTest extends TestCase
{
    public function testMicrosoftTeams(): void
    {
        $this->markTestSkipped(self::class.' is skipped.');

        $microsoftTeamsMessage = new MicrosoftTeamsMessage([
            'correlationId' => 'This is correlationId.',
            'expectedActors' => [
                'john@contoso.com',
            ],
            'originator' => 'This is originator.',
            'summary' => 'This is summary.',
            'themeColor' => '0076D7',
            'hideOriginalBody' => false,
            'title' => 'This is title.',
            'text' => 'This is text.',
            'sections' => [],
            'potentialAction' => [],
        ]);

        $microsoftTeamsMessage
            ->addSection([
                'title' => 'This is title.',
                'startGroup' => true,
                'activityImage' => 'This is activityImage.',
                'activityTitle' => 'This is activityTitle.',
                'activitySubtitle' => 'This is activitySubtitle.',
                'activityText' => 'This is activityText.',
                'heroImage' => 'This is heroImage.',
                'text' => 'This is text.',
                'facts' => [
                    [
                        'name' => 'This is name.',
                        'value' => 'This is value.',
                    ],
                ],
                'images' => [
                    'This is images.',
                ],
                'potentialAction' => [],
            ])
            ->addPotentialAction([
                '@type' => 'OpenUri',
                'name' => 'This is name.',
                'targets' => [
                    [
                        'os' => 'default',
                        'uri' => 'https://learn.microsoft.com/outlook/actionable-messages',
                    ],
                ],
            ])
            ->addPotentialAction([
                '@type' => 'HttpPOST',
                'name' => 'This is name.',
                'target' => 'https://learn.microsoft.com/outlook/actionable-messages',
                'headers' => [
                    [
                        'name' => 'X-Version',
                        'value' => 'v1.0.0',
                    ],
                ],
                'body' => [
                    'field' => 'value',
                ],
                'bodyContentType' => 'application/x-www-form-urlencoded',
            ])
            ->addPotentialAction([
                '@type' => 'ActionCard',
                'name' => 'This is name.',
                'inputs' => [
                    [
                        '@type' => 'TextInput',
                        'id' => 'comment',
                        'isRequired' => true,
                        'title' => 'This is title.',
                        'value' => 'This is value.',
                        'isMultiline' => true,
                    ],
                ],
                'actions' => [],
            ])
            ->addPotentialAction([
                '@type' => 'InvokeAddInCommand',
                'name' => 'This is name.',
                'addInId' => '527104a1-f1a5-475a-9199-7a968161c870',
                'desktopCommandId' => 'show',
                'initializationContext' => [
                    'property1' => 'This is property1.',
                    'property2' => 'This is property2.',
                ],
            ]);

        $this->expectException(ClientException::class);

        Factory::microsoftTeams()
            ->setWebhookUrl('url')
            ->setMessage($microsoftTeamsMessage)
            ->send();
    }
}
