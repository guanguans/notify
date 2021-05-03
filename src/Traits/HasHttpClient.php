<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Traits;

use Overtrue\Http\Client;

trait HasHttpClient
{
    /**
     * @var \Overtrue\Http\Client
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected static $httpOptions = [];

    public function setHttpOptions(array $httpOptions): self
    {
        static::$httpOptions = array_merge(static::$httpOptions, $httpOptions);

        return $this;
    }

    public static function getHttpOptions(): array
    {
        return static::$httpOptions;
    }

    public function getHttpClient(array $config = []): Client
    {
        $config && $this->setHttpOptions($config);

        if ($config || ! $this->httpClient instanceof Client) {
            $this->httpClient = Client::create(self::$httpOptions);
        }

        return $this->httpClient;
    }
}
