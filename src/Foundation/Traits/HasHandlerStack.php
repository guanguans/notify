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

use GuzzleHttp\HandlerStack;

/**
 * @mixin HasHttpClient
 */
trait HasHandlerStack
{
    private ?HandlerStack $handlerStack;

    public function getHandlerStack(): HandlerStack
    {
        return $this->handlerStack ?? HandlerStack::create();
    }

    public function setHandlerStack(HandlerStack $handlerStack): self
    {
        $this->handlerStack = $handlerStack;

        return $this;
    }

    /**
     * @noinspection MissingReturnTypeInspection
     * @noinspection PhpInconsistentReturnPointsInspection
     * @noinspection MissingParameterTypeDeclarationInspection
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this->handlerStack, $name)) {
            $this->handlerStack->{$name}(...$arguments);

            return $this;
        }

        new \BadMethodCallException(sprintf('Call to undefined method %s::%s', static::class, $name));
    }
}
