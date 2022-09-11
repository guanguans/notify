<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

class IGotClient extends Client
{
    /**
     * @var string
     */
    public const REQUEST_URL_TEMPLATE = 'https://push.hellyw.com/%s';

    /**
     * {@inheritdoc}
     */
    protected $requestMethod = 'postJson';

    /**
     * {@inheritdoc}
     */
    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE, $this->getToken());
    }
}
