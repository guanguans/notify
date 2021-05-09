<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

class FeiShuClient extends Client
{
    public const REQUEST_URL_TEMPLATE = 'https://open.feishu.cn/open-apis/bot/v2/hook/%s';

    protected $requestMethod = 'postJson';

    public function getRequestUrl(): string
    {
        return sprintf(static::REQUEST_URL_TEMPLATE, $this->getToken());
    }
}
