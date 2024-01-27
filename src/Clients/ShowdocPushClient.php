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

class ShowdocPushClient extends Client
{
    public const REQUEST_URL_TEMPLATE = 'https://push.showdoc.com.cn/server/api/push//%s';

    public function getRequestUrl(): string
    {
        return sprintf(self::REQUEST_URL_TEMPLATE, $this->getToken());
    }
}
