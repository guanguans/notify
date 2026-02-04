<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation\Contracts;

use Psr\Http\Message\RequestInterface;

interface Authenticator
{
    public function applyToOptions(array $options): array;

    public function applyToRequest(RequestInterface $request): RequestInterface;

    /**
     * @see \GuzzleHttp\HandlerStack::create()
     * @see \GuzzleHttp\HandlerStack::resolve()
     */
    public function applyToMiddleware(callable $handler): callable;
}
