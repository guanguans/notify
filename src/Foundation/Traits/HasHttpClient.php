<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Traits;

use GuzzleHttp\Client;

trait HasHttpClient
{
    protected ?Client $httpClient;

    protected array $httpOptions = [];

    public function setHttpOptions(array $httpOptions): self
    {
        $this->httpOptions = array_merge($this->httpOptions, $httpOptions);

        return $this;
    }

    public function getHttpOptions(): array
    {
        return $this->httpOptions;
    }

    public function getHttpClient(array $config = []): Client
    {
        $config && $this->setHttpOptions($config);

        if ($config || ! $this->httpClient instanceof Client) {
            $this->httpClient = new Client($this->httpOptions);
        }

        return $this->httpClient;
    }
}
