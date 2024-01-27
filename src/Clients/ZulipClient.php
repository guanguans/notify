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

class ZulipClient extends Client
{
    public const REQUEST_URL_TEMPLATE = '%s/api/v1/messages';

    /**
     * @var array<string>
     */
    protected array $defined = [
        'token',
        'message',
        'base_uri',
        'email',
    ];

    public function __construct(array $options = [])
    {
        $this->sending(static function (self $client): void {
            $client->setHttpOptions([
                'auth' => [
                    $client->getEmail(),
                    $client->getToken(),
                ],
            ]);
        });

        parent::__construct($options);
    }

    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE, $this->getBaseUri());
    }

    public function getBaseUri(): string
    {
        return $this->getOption('base_uri');
    }

    /**
     * @return $this
     */
    public function setBaseUri(string $baseUri): self
    {
        $this->setOption('base_uri', $baseUri);

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
