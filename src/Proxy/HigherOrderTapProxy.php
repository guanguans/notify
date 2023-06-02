<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Proxy;

/**
 * This file from `Illuminate\Support`.
 */
class HigherOrderTapProxy
{
    public $target;

    /**
     * HigherOrderTapProxy constructor.
     */
    public function __construct($target)
    {
        $this->target = $target;
    }

    public function __call($method, $parameters)
    {
        $this->target->{$method}(...$parameters);

        return $this->target;
    }
}
