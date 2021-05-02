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

    /**
     * @param array $httpOptions
     */
    public static function setHttpOptions($httpOptions = [])
    {
        self::$httpOptions = $httpOptions;
    }

    public static function getHttpOptions(): array
    {
        return self::$httpOptions;
    }

    public function getHttpClient(array $config = []): Client
    {
        $config && self::$httpOptions = array_merge($config);
        if ($config || ! $this->httpClient instanceof Client) {
            $this->httpClient = Client::create(self::$httpOptions);
        }

        return $this->httpClient;
    }
}
