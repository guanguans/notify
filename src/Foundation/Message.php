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

use Guanguans\Notify\Foundation\Concerns\Dumpable;
use Guanguans\Notify\Foundation\Concerns\HasOptions;
use Guanguans\Notify\Foundation\Concerns\Makeable;

abstract class Message implements \ArrayAccess, Contracts\Message
{
    use Dumpable;
    use HasOptions;
    use Makeable;

    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    public function __debugInfo()
    {
        return $this->withDebugInfo([
            'httpMethod' => $this->toHttpMethod(),
            'httpUri' => $this->toHttpUri(),
            'httpOptions' => $this->toHttpOptions(),
        ]);
    }
}
