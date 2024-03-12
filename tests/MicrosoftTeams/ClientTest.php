<?php

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\NotifyTests\MicrosoftTeams;

use Guanguans\Notify\MicrosoftTeams\Authenticator;
use Guanguans\Notify\MicrosoftTeams\Client;
use Guanguans\Notify\MicrosoftTeams\Messages\Message;
use function Pest\Faker\faker;

it('can send message', function (): void {
    $authenticator = new Authenticator('Your webhook url.');
    $client = new Client($authenticator);
    $message = Message::make([
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
    ])
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

    expect($client)
        ->mock([
            create_response(faker()->text()),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
