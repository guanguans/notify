<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

class ZulipClient extends Client
{
    public const REQUEST_URL_TEMPLATE = '%s/api/v1/messages';

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
        'host',
        'email',
    ];

    public function __construct(array $options = [])
    {
        $this->sending(function (self $client) {
            $client->setHttpOptions([
                'auth' => [
                    $client->getOption('email'),
                    $client->getOption('token'),
                ],
            ]);
        });

        parent::__construct($options);
    }

    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE, $this->getHost());
    }

    public function getHost(): string
    {
        return $this->getOption('host');
    }

    /**
     * @return $this
     */
    public function setHost(string $host): self
    {
        $this->setOption('host', $host);

        return $this;
    }

    public function getEmail(): string
    {
        return $this->getOption('email');
    }

    /**
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->setOption('email', $email);

        return $this;
    }
}
