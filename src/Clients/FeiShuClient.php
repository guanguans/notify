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

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
        'secret',
    ];

    public function getRequestUrl(): string
    {
        return sprintf(static::REQUEST_URL_TEMPLATE, $this->getToken());
    }

    /**
     * @return $this
     */
    public function setSecret(string $secret)
    {
        $this->setOption('secret', $secret);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRequestParams(): array
    {
        $requestParams = parent::getRequestParams();

        if (array_key_exists('secret', $this->getOptions()) && $this->getOptions('secret')) {
            $requestParams['timestamp'] = time();
            $requestParams['sign'] = $this->getSign($this->options['secret'], $requestParams['timestamp']);
        }

        return $requestParams;
    }

    /**
     * @return string
     */
    protected function getSign(string $secret, int $timestamp)
    {
        $key = sprintf("%s\n%s", $timestamp, $secret);

        $hash = hash_hmac('sha256', '', $key, true);

        return base64_encode($hash);
    }
}
