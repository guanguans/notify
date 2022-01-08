<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

/**
 * @see https://pushback.io/docs/getting-started
 *
 * ```
 * curl https://api.pushback.io/v1/send_sync \
 * -u at_uDCCK8gdHJPN613lASV: \
 * -d 'id=User_1730' \
 * -d 'title=Send notifications' \
 * -d 'body=Get responses back' \
 * -d 'action1=Action1' \
 * -d 'action2=Action2' \
 * -d 'reply=Reply'
 * ```
 */
class PushBackClient extends Client
{
    public const REQUEST_URL_TEMPLATE = 'https://api.pushback.io/v1/%s';

    /**
     * @var array
     */
    protected $options = [
        'synchronous_mode' => false,
    ];

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
        'synchronous_mode',
    ];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'synchronous_mode' => 'bool',
    ];

    /**
     * {@inheritdoc}
     */
    public function __construct(array $options = [])
    {
        $this->sending(function (self $client) {
            $this->setHttpOptions([
                'auth' => [
                    $client->getToken(),
                    null,
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
        return sprintf(self::REQUEST_URL_TEMPLATE, $this->isSynchronousMode() ? 'send_sync' : 'send');
    }

    public function isSynchronousMode(): bool
    {
        return $this->getOption('synchronous_mode');
    }

    /**
     * @return $this
     */
    public function setSynchonousMode(bool $synchronousMode = true): self
    {
        $this->setOption('synchronous_mode', $synchronousMode);

        return $this;
    }
}
