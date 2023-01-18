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
 * List rooms.
 * ```
 * curl --location --request GET 'https://api.gitter.im/v1/rooms' \
 * --header 'Accept: application/json' \
 * --header 'Authorization: Bearer {{token}}'.
 * ```.
 *
 * Send a Message.
 * ```
 * curl --location --request POST 'https://api.gitter.im/v1/rooms/{{room_id}}/chatMessages' \
 * --header 'Content-Type: application/json' \
 * --header 'Accept: application/json' \
 * --header 'Authorization: Bearer {{token}}' \
 * --data-raw '{"text":"This is a testing."}'
 * ```
 */
class GitterClient extends Client
{
    /**
     * @var string
     */
    public const REQUEST_URL_TEMPLATE = 'https://api.gitter.im/v1/rooms/%s/chatMessages';

    /**
     * @var string
     */
    public $requestMethod = 'postJson';

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
        'room_id',
    ];

    public function __construct(array $options = [])
    {
        $this->sending(static function (self $client): void {
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
        return sprintf(static::REQUEST_URL_TEMPLATE, $this->getRoomId());
    }

    public function getRoomId(): string
    {
        return $this->getOption('room_id');
    }

    /**
     * @return $this
     */
    public function setRoomId(string $roomId): self
    {
        $this->setOption('room_id', $roomId);

        return $this;
    }
}
