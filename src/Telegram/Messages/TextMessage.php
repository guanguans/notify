<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Telegram\Messages;

/**
 * @method \Guanguans\Notify\Telegram\Messages\TextMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\TextMessage text($text)
 * @method \Guanguans\Notify\Telegram\Messages\TextMessage parseMode($parseMode)
 * @method \Guanguans\Notify\Telegram\Messages\TextMessage entities(array $entities)
 * @method \Guanguans\Notify\Telegram\Messages\TextMessage disableWebPagePreview($disableWebPagePreview)
 * @method \Guanguans\Notify\Telegram\Messages\TextMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\TextMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\TextMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\TextMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\TextMessage replyMarkup(array $replyMarkup)
 */
class TextMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'chat_id',
        'text',
        'parse_mode',
        'entities',
        'disable_web_page_preview',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];

    /**
     * @var array<array<\string>>
     */
    protected array $allowedValues = [
        'parse_mode' => ['HTML', 'Markdown', 'MarkdownV2'],
    ];

    protected array $allowedTypes = [
        'entities' => 'array',
        'disable_web_page_preview' => 'bool',
        'disable_notification' => 'bool',
        'protect_content' => 'bool',
        'allow_sending_without_reply' => 'bool',
        'reply_markup' => 'array',
    ];
}
