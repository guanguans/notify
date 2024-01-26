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
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage chatId($chatId)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage latitude($latitude)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage longitude($longitude)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage title($title)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage address($address)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage foursquareId($foursquareId)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage foursquareType($foursquareType)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage googlePlaceId($googlePlaceId)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage googlePlaceType($googlePlaceType)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage disableNotification($disableNotification)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage protectContent($protectContent)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage replyToMessageId($replyToMessageId)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage allowSendingWithoutReply($allowSendingWithoutReply)
 * @method \Guanguans\Notify\Telegram\Messages\VenueMessage replyMarkup($replyMarkup)
 */
class VenueMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'chat_id',
        'latitude',
        'longitude',
        'title',
        'address',
        'foursquare_id',
        'foursquare_type',
        'google_place_id',
        'google_place_type',
        'disable_notification',
        'protect_content',
        'reply_to_message_id',
        'allow_sending_without_reply',
        'reply_markup',
    ];
}
