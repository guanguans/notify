<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

class PushPlusClient extends Client
{
    public const REQUEST_URL_TEMPLATE = 'https://pushplus.hxtrip.com/send?token=%s';

    /**
     * {@inheritdoc}
     */
    public function __construct(array $options = [])
    {
        $this->sending(function (self $client) {
            $client->setHttpOptions([
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);
        });

        parent::__construct($options);
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE, $this->getToken());
    }
}
