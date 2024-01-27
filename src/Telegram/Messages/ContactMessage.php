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
 * @method \Guanguans\Notify\Telegram\Messages\ContactMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\ContactMessage phoneNumber($phoneNumber)
 * @method \Guanguans\Notify\Telegram\Messages\ContactMessage firstName($firstName)
 * @method \Guanguans\Notify\Telegram\Messages\ContactMessage lastName($lastName)
 * @method \Guanguans\Notify\Telegram\Messages\ContactMessage vcard($vcard)
 * @method \Guanguans\Notify\Telegram\Messages\ContactMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\ContactMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\ContactMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\ContactMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\ContactMessage replyMarkup($replyMarkup)
 */
class ContactMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'chat_id',
        'phone_number',
        'first_name',
        'last_name',
        'vcard',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
