<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

/**
 * @see https://telegram.me/botfather
 * @see https://core.telegram.org/bots/api#getupdates
 * @see https://api.telegram.org/botxxx:yyy/getUpdates
 * @see https://core.telegram.org/bots/api#sendmessage
 * @see https://api.telegram.org/botxxx:yyy/sendMessage?chat_id=xx&text=text
 */
class TelegramClient extends Client
{
    public const REQUEST_URL_TEMPLATE = 'https://api.telegram.org/bot%s/sendMessage';

    public const UPDATES_REQUEST_URL_TEMPLATE = 'https://api.telegram.org/bot%s/getUpdates';

    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE, $this->getToken());
    }

    public function getUpdates(array $params = ['limit' => 3])
    {
        return $this->wrapSendCallbacksWithRequestAsync(function () use ($params) {
            return $this->getHttpClient()
                ->{$this->getRequestMethod()}(
                    sprintf(static::UPDATES_REQUEST_URL_TEMPLATE, $this->getToken()),
                    $params
                );
        });
    }
}
