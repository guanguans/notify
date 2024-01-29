<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation;

use Guanguans\Notify\Foundation\Traits\Conditionable;
use Guanguans\Notify\Foundation\Traits\HasOptions;
use Guanguans\Notify\Foundation\Traits\Makeable;
use Guanguans\Notify\Foundation\Traits\Tappable;

abstract class Message implements \ArrayAccess, Contracts\Message
{
    use Conditionable;
    use HasOptions;
    use Makeable;
    use Tappable;

    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }
}
