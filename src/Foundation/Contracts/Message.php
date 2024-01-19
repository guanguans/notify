<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Contracts;

use Psr\Http\Message\StreamInterface;

interface Message extends \ArrayAccess
{
    /**
     * @return string|resource|array|object|StreamInterface
     */
    public function toPayload();
}
