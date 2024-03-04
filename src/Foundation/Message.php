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

/**
 * @template-implements \ArrayAccess<string, mixed>
 */
abstract class Message implements \ArrayAccess, Contracts\Message
{
    use Dumpable;
    use HasOptions;

    protected bool $ignoreUndefined = true;

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

    /**
     * @return static
     */
    public static function make(...$parameters): self
    {
        return new static(...$parameters);
    }
}
