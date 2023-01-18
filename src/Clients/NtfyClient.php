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

use GuzzleHttp\RequestOptions;

/**
 * @see https://ntfy.sh
 * @see https://docs.ntfy.sh/publish/
 */
class NtfyClient extends Client
{
    protected $requestMethod = 'postJson';

    /**
     * @var string[]
     */
    protected $defined = [
        'message',
        'base_uri',
        'username',
        'password',
    ];

    /**
     * @var string[]
     */
    protected $options = [
        'base_uri' => 'https://ntfy.sh',
    ];

    public function __construct(array $options = [])
    {
        $this->sending(function (self $client): void {
            if ($this->getUsername() || $this->getPassword()) {
                $client->setHttpOptions([
                    RequestOptions::AUTH => [
                        $this->getUsername(),
                        $this->getPassword(),
                    ],
                ]);
            }
        });

        parent::__construct($options);
    }

    /**
     * @return $this
     */
    public function setBaseUri(string $baseUri): self
    {
        $this->setOption('base_uri', $baseUri);

        return $this;
    }

    public function getBaseUri(): string
    {
        return $this->getOption('base_uri');
    }

    /**
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->setOption('username', $username);

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->getOption('username');
    }

    /**
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->setOption('password', $password);

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->getOption('password');
    }

    public function getRequestUrl(): string
    {
        return $this->getBaseUri();
    }
}
