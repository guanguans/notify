<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Http;

use Overtrue\Http\Client as OvertrueClient;

class Client extends OvertrueClient
{
    /**
     * @return \Psr\Http\Message\ResponseInterface|\Overtrue\Http\Support\Collection|array|object|string
     */
    public function postJson(string $uri, array $data = [], array $options = [], bool $async = false)
    {
        return $this->request($uri, 'POST', \array_merge($options, ['json' => $data]), $async);
    }

    /**
     * @return array|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string
     */
    public function postJsonAsync(string $uri, array $data = [], array $options = [])
    {
        return $this->post($uri, $data, $options, true);
    }
}
