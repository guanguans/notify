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
 * @method self horizontalAccuracy($horizontalAccuracy)
 * @method self livePeriod($livePeriod)
 * @method self heading($heading)
 * @method self proximityAlertRadius($proximityAlertRadius)
 * @method self disableNotification($disableNotification)
 * @method self protectContent($protectContent)
 * @method self replyParameters($replyParameters)
 * @method self replyMarkup($replyMarkup)
 */
class LocationMessage extends Message
{
    protected array $defined = [
        'chat_id',
        'message_thread_id',
        'latitude',
        'longitude',
        'horizontal_accuracy',
        'live_period',
        'heading',
        'proximity_alert_radius',
        'disable_notification',
        'protect_content',
        'reply_parameters',
        'reply_markup',
    ];

    public function toHttpUri(): string
    {
        return 'bot{token}/sendLocation';
    }
}
