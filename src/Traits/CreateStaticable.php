<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Traits;

trait CreateStaticable
{
    /**
     * @noRector \Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnNewRector
     *
     * @return static
     */
    public static function create(...$parameters)
    {
        return new static(...$parameters);
    }
}
