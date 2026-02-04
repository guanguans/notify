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
 * @method self chatId(mixed $chatId)
 * @method self disableNotification(mixed $disableNotification)
 * @method self heading(mixed $heading)
 * @method self horizontalAccuracy(mixed $horizontalAccuracy)
 * @method self latitude(mixed $latitude)
 * @method self livePeriod(mixed $livePeriod)
 * @method self longitude(mixed $longitude)
 * @method self messageThreadId(mixed $messageThreadId)
 * @method self protectContent(mixed $protectContent)
 * @method self proximityAlertRadius(mixed $proximityAlertRadius)
 * @method self replyMarkup(mixed $replyMarkup)
 * @method self replyParameters(mixed $replyParameters)
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
