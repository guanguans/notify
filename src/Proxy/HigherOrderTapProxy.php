<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Proxy;

class HigherOrderTapProxy
{
    /**
     * @var mixed
     */
    public $target;

    /**
     * HigherOrderTapProxy constructor.
     *
     * @param $target
     */
    public function __construct($target)
    {
        $this->target = $target;
    }

    /**
     * @param $method
     * @param $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $this->target->{$method}(...$parameters);

        return $this->target;
    }
}
