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
 * @method self messageThreadId($messageThreadId)
 * @method self latitude($latitude)
 * @method self longitude($longitude)
 * @method self title($title)
 * @method self address($address)
 * @method self foursquareId($foursquareId)
 * @method self foursquareType($foursquareType)
 * @method self googlePlaceId($googlePlaceId)
 * @method self googlePlaceType($googlePlaceType)
 * @method self disableNotification($disableNotification)
 * @method self protectContent($protectContent)
 * @method self replyParameters($replyParameters)
 * @method self replyMarkup($replyMarkup)
 */
class VenueMessage extends Message
{
    protected array $defined = [
        'chat_id',
        'message_thread_id',
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
        'reply_parameters',
        'reply_markup',
    ];

    public function toHttpUri(): string
    {
        return 'bot{token}/sendVenue';
    }
}
