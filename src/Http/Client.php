<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Http;

class Client extends \Overtrue\Http\Client
{
    /**
     * @param bool $async
     *
     * @return \Psr\Http\Message\ResponseInterface|\Overtrue\Http\Support\Collection|array|object|string
     */
    public function postJson(string $uri, array $data = [], array $options = [], $async = false)
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
