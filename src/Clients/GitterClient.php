<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

use Guanguans\Notify\Contracts\MessageInterface;

class GitterClient extends Client
{
    public const REQUEST_URL_TEMPLATE = 'https://api.gitter.im/v1/rooms/%s/chatMessages';

    public $requestMethod = 'postJson';

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
        'room_id',
    ];

    public function getRequestUrl(): string
    {
        return sprintf(static::REQUEST_URL_TEMPLATE, $this->getRoomId());
    }

    public function getRoomId(): string
    {
        return $this->getOption('room_id');
    }

    /**
     * @return $this
     */
    public function setRoomId(string $token)
    {
        $this->setOption('room_id', $token);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function send(MessageInterface $message = null)
    {
        $this->setHttpOptions([
            'headers' => [
                'Authorization' => 'Bearer '.$this->getToken(),
            ],
        ]);

        return parent::send($message);
    }
}
