<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

class DingTalkClient extends Client
{
    public const REQUEST_URL_TEMPLATE = 'https://oapi.dingtalk.com/robot/send?access_token=%s';

    protected $requestMethod = 'postJson';

    public function getRequestUrl(): string
    {
        $params = $this->getRequestParams();
        if (isset($params['timestamp'])) {
            $urlParams = http_build_query([
                'timestamp' => $params['timestamp'],
                'sign' => $params['sign'],
            ]);
        }

        return sprintf(static::REQUEST_URL_TEMPLATE, $this->getToken()).'&'.$urlParams;
    }
}
