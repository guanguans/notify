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

use Guanguans\Notify\Foundation\Traits\HasOptions;
use Guanguans\Notify\Traits\CreateStaticable;
use Psr\Http\Message\StreamInterface;

abstract class Message implements Contracts\Message
{
    use CreateStaticable;
    use HasOptions;

    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * @return string|array|object|resource|StreamInterface
     *
     * @noinspection PhpReturnDocTypeMismatchInspection
     */
    public function toPayload()
    {
        return $this->options;
    }
}
