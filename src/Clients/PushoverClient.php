<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

class PushoverClient extends Client
{
    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'user_token',
        'message',
    ];

    /**
     * @var string
     */
    public const REQUEST_URL_TEMPLATE = 'https://api.pushover.net/1/messages.json';

    /**
     * @var string
     */
    public const VALIDATION_USER_REQUEST_URL_TEMPLATE = 'https://api.pushover.net/1/users/validate.json';

    /**
     * @var string
     */
    public const SOUNDS_REQUEST_URL_TEMPLATE = 'https://api.pushover.net/1/sounds.json?token=%s';

    public function validateUser()
    {
        return $this->wrapSendCallbacksWithRequestAsync(function () {
            return $this->getHttpClient()->{$this->getRequestMethod()}(
                static::VALIDATION_USER_REQUEST_URL_TEMPLATE,
                [
                    'token' => $this->options['token'] ?? null,
                    'user' => $this->options['user_token'] ?? null,
                ]
            );
        });
    }

    public function sounds()
    {
        return $this->wrapSendCallbacksWithRequestAsync(function () {
            return $this->getHttpClient()->get(
                sprintf(static::SOUNDS_REQUEST_URL_TEMPLATE, $this->options['token'] ?? '')
            );
        });
    }

    /**
     * @return $this
     */
    public function setUserToken(string $userToken): self
    {
        $this->setOption('user_token', $userToken);

        return $this;
    }

    public function getUserToken(): string
    {
        return $this->getOption('user_token');
    }

    /**
     * {@inheritDoc}
     */
    public function getRequestParams(): array
    {
        return parent::getRequestParams() + [
            'token' => $this->options['token'] ?? null,
            'user' => $this->options['user_token'] ?? null,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getRequestUrl(): string
    {
        return static::REQUEST_URL_TEMPLATE;
    }
}
