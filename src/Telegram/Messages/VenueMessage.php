<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Telegram\Messages;

/**
 * @method self address(mixed $address)
 * @method self chatId(mixed $chatId)
 * @method self disableNotification(mixed $disableNotification)
 * @method self foursquareId(mixed $foursquareId)
 * @method self foursquareType(mixed $foursquareType)
 * @method self googlePlaceId(mixed $googlePlaceId)
 * @method self googlePlaceType(mixed $googlePlaceType)
 * @method self latitude(mixed $latitude)
 * @method self longitude(mixed $longitude)
 * @method self messageThreadId(mixed $messageThreadId)
 * @method self protectContent(mixed $protectContent)
 * @method self replyMarkup(mixed $replyMarkup)
 * @method self replyParameters(mixed $replyParameters)
 * @method self title(mixed $title)
 */
class VenueMessage extends AbstractMessage
{
    /** @var list<string> */
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
