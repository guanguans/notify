<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

class ServerChanClient extends Client
{
    public const REQUEST_URL_TEMPLATE = 'https://sctapi.ftqq.com/%s.send';

    public const CHECK_REQUEST_URL_TEMPLATE = 'https://sctapi.ftqq.com/push?id=%s&readkey=%s';

    public function getRequestUrl(): string
    {
        return sprintf(static::REQUEST_URL_TEMPLATE, $this->getToken());
    }

    public function check(int $pushId, string $readKey)
    {
        return $this->wrapSendCallbacksWithRequestAsync(function () use ($pushId, $readKey) {
            return $this->getHttpClient()->get(sprintf(static::CHECK_REQUEST_URL_TEMPLATE, $pushId, $readKey));
        });
    }
}
