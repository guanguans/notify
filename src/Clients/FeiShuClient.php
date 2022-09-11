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
    /**
     * @var string
     */
    public const REQUEST_URL_TEMPLATE = 'https://open.feishu.cn/open-apis/bot/v2/hook/%s';

    /**
     * @var string
     */
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

    public function getSecret(): string
    {
        return $this->getOption('secret');
    }

    /**
     * @return $this
     */
    public function setSecret(string $secret): self
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
        if ($this->has('secret') && $this->getSecret()) {
            $requestParams['timestamp'] = time();
            $requestParams['sign'] = $this->getSign($this->getSecret(), $requestParams['timestamp']);
        }

        return $requestParams;
    }

    protected function getSign(string $secret, int $timestamp): string
    {
        $key = sprintf("%s\n%s", $timestamp, $secret);

        $hash = hash_hmac('sha256', '', $key, true);

        return base64_encode($hash);
    }
}
