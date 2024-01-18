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

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

trait CreatesDefaultHttpClient
{
    protected array $middlewares = [];
    protected ?HandlerStack $handlerStack = null;

    public function createDefaultHttClient(array $options): Client
    {
        return new Client(array_merge([
            'handler' => $this->getHandlerStack(),
        ], $options));
    }

    public function pushMiddleware(callable $middleware, string $name = null): self
    {
        if (null !== $name) {
            $this->middlewares[$name] = $middleware;
        } else {
            $this->middlewares[] = $middleware;
        }

        return $this;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function setMiddlewares(array $middlewares): self
    {
        $this->middlewares = $middlewares;

        return $this;
    }

    public function setHandlerStack(HandlerStack $handlerStack): self
    {
        $this->handlerStack = $handlerStack;

        return $this;
    }

    public function getHandlerStack(): HandlerStack
    {
        if ($this->handlerStack) {
            return $this->handlerStack;
        }

        $this->handlerStack = HandlerStack::create();

        foreach ($this->middlewares as $name => $middleware) {
            $this->handlerStack->push($middleware, $name);
        }

        return $this->handlerStack;
    }
}
