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
    public const REQUEST_URL_TEMPLATE = 'https://oapi.dingtalk.com/robot/send?access_token=%s&%s';

    protected $requestMethod = 'postJson';

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
        'secret',
    ];

    /**
     * @return $this
     */
    public function setSecret(string $secret)
    {
        $this->setOption('secret', $secret);

        return $this;
    }

    public function getRequestUrl(): string
    {
        $urlParams = '';
        if (isset($this->options['secret']) && $this->getOption('secret')) {
            $urlParams = http_build_query([
                'timestamp' => $timestamp = time().sprintf('%03d', random_int(1, 999)),
                'sign' => $this->getSign($this->getOption('secret'), $timestamp),
            ]);
        }

        return sprintf(static::REQUEST_URL_TEMPLATE, $this->getToken(), $urlParams);
    }

    /**
     * @return string
     */
    protected function getSign(string $secret, int $timestamp)
    {
        $data = sprintf("%s\n%s", $timestamp, $secret);

        $hash = hash_hmac('sha256', $data, $secret, true);

        return urlencode(base64_encode($hash));
    }
}
