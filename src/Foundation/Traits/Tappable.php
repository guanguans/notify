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

/**
 * @see https://github.com/laravel/framework/blob/10.x/src/Illuminate/Support/Traits/Tappable.php
 */
trait Tappable
{
    /**
     * Call the given Closure with this instance then return the instance.
     */
    public function tap(?callable $callback = null): self
    {
        return tap($this, $callback);
    }
}
