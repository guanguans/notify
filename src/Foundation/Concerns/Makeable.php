<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Concerns;

trait Makeable
{
    /**
     * @return static
     */
    public static function make(...$parameters): self
    {
        return new static(...$parameters);
    }
}
