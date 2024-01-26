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
 * @method \Guanguans\Notify\Telegram\Messages\LocationMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\LocationMessage latitude($latitude)
 * @method \Guanguans\Notify\Telegram\Messages\LocationMessage longitude($longitude)
 * @method \Guanguans\Notify\Telegram\Messages\LocationMessage horizontalAccuracy($horizontalAccuracy)
 * @method \Guanguans\Notify\Telegram\Messages\LocationMessage livePeriod($livePeriod)
 * @method \Guanguans\Notify\Telegram\Messages\LocationMessage heading($heading)
 * @method \Guanguans\Notify\Telegram\Messages\LocationMessage proximityAlertRadius($proximityAlertRadius)
 * @method \Guanguans\Notify\Telegram\Messages\LocationMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\LocationMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\LocationMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\LocationMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\LocationMessage replyMarkup($replyMarkup)
 */
class LocationMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'chat_id',
        'latitude',
        'longitude',
        'horizontal_accuracy',
        'live_period',
        'heading',
        'proximity_alert_radius',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
