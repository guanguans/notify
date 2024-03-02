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
 * @method self chatId($chatId)
 * @method self phoneNumber($phoneNumber)
 * @method self firstName($firstName)
 * @method self lastName($lastName)
 * @method self vcard($vcard)
 * @method self disableNotification($disableNotification)
 * @method self protectContent($protectContent)
 * @method self replyToMessageId($replyToMessageId)
 * @method self allowSendingWithoutReply($allowSendingWithoutReply)
 * @method self replyMarkup($replyMarkup)
 */
class ContactMessage extends Message
{
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
