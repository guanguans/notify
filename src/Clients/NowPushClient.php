<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

class NowPushClient extends Client
{
    public const REQUEST_URL_TEMPLATE = 'https://www.api.nowpush.app/v3/%s';

    public function __construct(array $options = [])
    {
        $this->sending(function (self $client) {
            $client->setHttpOptions([
                'headers' => [
                    'Authorization' => 'Bearer '.$client->getToken(),
                ],
            ]);
        });

        parent::__construct($options);
    }

    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE, 'sendMessage');
    }

    /**
     * @return array|\GuzzleHttp\Promise\PromiseInterface|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string
     */
    public function getUser()
    {
        $this->callSendingCallbacks();

        $response = $this->getHttpClient()->get(sprintf(self::REQUEST_URL_TEMPLATE, 'getUser'));

        $this->callSendedCallbacks();

        return $response;
    }
}
