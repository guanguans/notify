<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Traits;

use Guanguans\Notify\Http\Client;

trait HasHttpClient
{
    /**
     * @var \Guanguans\Notify\Http\Client
     */
    protected $httpClient;

    protected $httpOptions = [];

    public function setHttpOptions(array $httpOptions)
    {
        $this->httpOptions = array_merge($this->httpOptions, $httpOptions);

        return $this;
    }

    /**
     * @return mixed[]
     */
    public function getHttpOptions(): array
    {
        return $this->httpOptions;
    }

    public function getHttpClient(array $config = []): Client
    {
        $config && $this->setHttpOptions($config);

        if ($config || ! $this->httpClient instanceof Client) {
            $this->httpClient = Client::create($this->httpOptions);
        }

        return $this->httpClient;
    }
}
