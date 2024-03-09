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

namespace Guanguans\NotifyTests\Telegram;

use Guanguans\Notify\Telegram\Authenticator;
use Guanguans\Notify\Telegram\Client;
use Guanguans\Notify\Telegram\Messages\AnimationMessage;
use Guanguans\Notify\Telegram\Messages\AudioMessage;
use Guanguans\Notify\Telegram\Messages\ChatActionMessage;
use Guanguans\Notify\Telegram\Messages\ContactMessage;
use Guanguans\Notify\Telegram\Messages\DiceMessage;
use Guanguans\Notify\Telegram\Messages\DocumentMessage;
use Guanguans\Notify\Telegram\Messages\GetUpdatesMessage;
use Guanguans\Notify\Telegram\Messages\LocationMessage;
use Guanguans\Notify\Telegram\Messages\MediaGroupMessage;
use Guanguans\Notify\Telegram\Messages\PhotoMessage;
use Guanguans\Notify\Telegram\Messages\PollMessage;
use Guanguans\Notify\Telegram\Messages\TextMessage;
use Guanguans\Notify\Telegram\Messages\VenueMessage;
use Guanguans\Notify\Telegram\Messages\VideoMessage;
use Guanguans\Notify\Telegram\Messages\VideoNoteMessage;
use Guanguans\Notify\Telegram\Messages\VoiceMessage;

beforeEach(function (): void {
    $authenticator = new Authenticator('6825137102:AAHQvvBpsoJVs-lQSKjZNLELMmpzQ50p');
    $this->client = (new Client($authenticator))->mock([
        create_response('{"ok":true,"result":{"message_id":5,"from":{"id":6825137102,"is_bot":true,"first_name":"guanguansbot","username":"guanguand_bot"},"chat":{"id":6173634402,"first_name":"guanguans","type":"private"},"date":1708397315,"text":"This is text","entities":[{"offset":0,"length":12,"type":"bold"}]}}'),
        create_response('{"ok":false,"error_code":401,"description":"Unauthorized"}', 401),
    ]);
});

it('can send get updates message', function (): void {
    $getUpdatesMessage = GetUpdatesMessage::make([
        'limit' => 5,
    ]);

    expect($this->client)->assertCanSendMessage($getUpdatesMessage);
})->group(__DIR__, __FILE__);

it('can send text message', function (): void {
    $textMessage = TextMessage::make([
        'chat_id' => 6173634402,
        // 'message_thread_id' => 6173634402,
        'text' => '> This is text',
        'parse_mode' => 'MarkdownV2',
        'entities' => $entities = [
            $entity = [
                'type' => 'https://telegram.org',
                'offset' => 1,
                'length' => 32,
                'url' => 'https://github.com/guanguans/notify',
                'user' => [
                    'id' => 1,
                    'is_bot' => true,
                    'first_name' => 'This is first name',
                    'last_name' => 'This is last name',
                    'username' => 'This is username',
                ],
                'language' => 'pre',
                'custom_emoji_id' => 'emoji_id',
            ],
        ],
        'link_preview_options' => [
            'is_disabled' => false,
            'url' => 'https://github.com/guanguans/notify',
            'prefer_small_media' => false,
            'prefer_large_media' => false,
            'show_above_text' => true,
        ],
        'disable_notification' => false,
        'protect_content' => true,
        'reply_parameters' => [
            'message_id' => 6173634402,
            'chat_id' => 6173634402,
            'allow_sending_without_reply' => false,
            'quote' => 'This is quote',
            'quote_parse_mode' => 'HTML',
            'quote_entities' => $entities,
        ],
        'reply_markup' => [
            'force_reply' => false,
            'input_field_placeholder' => 'This is input field placeholder',
            'selective' => false,
        ],
    ])->addEntity($entity);

    expect($this->client)->assertCanSendMessage($textMessage);
})->group(__DIR__, __FILE__);

it('can send animation message', function (): void {
    $animationMessage = AnimationMessage::make([
        'chat_id' => 6173634402,
        'animation' => 'tests/fixtures/image.png',
        'caption_entities' => [
            $captionEntity = [
                'type' => 'https://telegram.org',
                'url' => 'https://github.com/guanguans/notify',
            ],
        ],
    ])->addCaptionEntity($captionEntity);

    expect($this->client)->assertCanSendMessage($animationMessage);
})->group(__DIR__, __FILE__);

it('can send audio message', function (): void {
    $audioMessage = AudioMessage::make([
        'chat_id' => 6173634402,
        'audio' => 'tests/fixtures/image.png',
        'caption_entities' => [
            $captionEntity = [
                'type' => 'https://telegram.org',
                'url' => 'https://github.com/guanguans/notify',
            ],
        ],
    ])->addCaptionEntity($captionEntity);

    expect($this->client)->assertCanSendMessage($audioMessage);
})->group(__DIR__, __FILE__);

it('can send chat action message', function (): void {
    $chatActionMessage = ChatActionMessage::make([
        'chat_id' => 6173634402,
        'action' => 'upload_photo',
    ]);

    expect($this->client)->assertCanSendMessage($chatActionMessage);
})->group(__DIR__, __FILE__);

it('can send contact message', function (): void {
    $contactMessage = ContactMessage::make([
        'chat_id' => 6173634402,
        'phone_number' => '13948484984',
        'first_name' => 'This is first name',
    ]);

    expect($this->client)->assertCanSendMessage($contactMessage);
})->group(__DIR__, __FILE__);

it('can send dice message', function (): void {
    $diceMessage = DiceMessage::make([
        'chat_id' => 6173634402,
        'emoji' => '🎲',
    ]);

    expect($this->client)->assertCanSendMessage($diceMessage);
})->group(__DIR__, __FILE__);

it('can send document message', function (): void {
    $documentMessage = DocumentMessage::make([
        'chat_id' => 6173634402,
        'document' => 'tests/fixtures/image.png',
        'caption_entities' => [
            $captionEntity = [
                'type' => 'https://telegram.org',
                'url' => 'https://github.com/guanguans/notify',
            ],
        ],
    ])->addCaptionEntity($captionEntity);

    expect($this->client)->assertCanSendMessage($documentMessage);
})->group(__DIR__, __FILE__);

it('can send location message', function (): void {
    $locationMessage = LocationMessage::make([
        'chat_id' => 6173634402,
        'latitude' => 40.25,
        'longitude' => 110.21,
    ]);

    expect($this->client)->assertCanSendMessage($locationMessage);
})->group(__DIR__, __FILE__);

it('can send media group message', function (): void {
    $mediaGroupMessage = MediaGroupMessage::make([
        'chat_id' => 6173634402,
        'media' => [
            $media = [
                'type' => 'photo',
                'media' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
            ],
        ],
    ])->addMedia($media);

    expect($this->client)->assertCanSendMessage($mediaGroupMessage);
})->group(__DIR__, __FILE__);

it('can send photo message', function (): void {
    $photoMessage = PhotoMessage::make([
        'chat_id' => 6173634402,
        // 'photo' => 'https://avatars.githubusercontent.com/u/22309277?v=4',
        // 'photo' => 'AgACAgQAAxkDAAMeZeVV5od56saRAAH9k_AC_wQZAAHd-AACma0xG7QSDVLARHylspn9xwEAAwIAA3gAAzQE',
        'photo' => 'tests/fixtures/image.png',
        'caption_entities' => [
            $captionEntity = [
                'type' => 'https://telegram.org',
                'url' => 'https://github.com/guanguans/notify',
            ],
        ],
    ])->addCaptionEntity($captionEntity);

    expect($this->client)->assertCanSendMessage($photoMessage);
})->group(__DIR__, __FILE__);

it('can send poll message', function (): void {
    $pollMessage = PollMessage::make([
        'chat_id' => 6173634402,
        'question' => 'This is question.',
        'options' => [
            'This is option 1.',
            'This is option 2.',
        ],
        'explanation_entities' => [
            $explanationEntity = [
                'type' => 'https://telegram.org',
                'url' => 'https://github.com/guanguans/notify',
            ],
        ],
    ])->addExplanationEntity($explanationEntity);

    expect($this->client)->assertCanSendMessage($pollMessage);
})->group(__DIR__, __FILE__);

it('can send venue message', function (): void {
    $venueMessage = VenueMessage::make([
        'chat_id' => 6173634402,
        'latitude' => 40.25,
        'longitude' => 110.21,
        'title' => 'This is title.',
        'address' => 'This is address.',
    ]);

    expect($this->client)->assertCanSendMessage($venueMessage);
})->group(__DIR__, __FILE__);

it('can send video message', function (): void {
    $videoMessage = VideoMessage::make([
        'chat_id' => 6173634402,
        'video' => 'tests/fixtures/image.png',
        'caption_entities' => [
            $captionEntity = [
                'type' => 'https://telegram.org',
                'url' => 'https://github.com/guanguans/notify',
            ],
        ],
    ])->addCaptionEntity($captionEntity);

    expect($this->client)->assertCanSendMessage($videoMessage);
})->group(__DIR__, __FILE__);

it('can send video note message', function (): void {
    $videoNoteMessage = VideoNoteMessage::make([
        'chat_id' => 6173634402,
        'video_note' => 'tests/fixtures/image.png',
    ]);

    expect($this->client)->assertCanSendMessage($videoNoteMessage);
})->group(__DIR__, __FILE__);

it('can send voice message', function (): void {
    $voiceMessage = VoiceMessage::make([
        'chat_id' => 6173634402,
        'voice' => 'tests/fixtures/image.png',
        'caption_entities' => [
            $captionEntity = [
                'type' => 'https://telegram.org',
                'url' => 'https://github.com/guanguans/notify',
            ],
        ],
    ])->addCaptionEntity($captionEntity);

    expect($this->client)->assertCanSendMessage($voiceMessage);
})->group(__DIR__, __FILE__);
