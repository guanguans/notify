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

class YiFengChuanHuaClient extends Client
{
    public const REQUEST_URL_TEMPLATE = 'https://www.phprm.com/services/push/trigger/%s';

    protected $requestMethod = 'postJson';

    public function getRequestUrl(): string
    {
        return sprintf(static::REQUEST_URL_TEMPLATE, $this->getToken());
    }

    public function setRequestMethod(string $requestMethod): self
    {
        $this->requestMethod = $requestMethod;

        return $this;
    }
}
