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

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\Foundation\Concerns\Dumpable;
use Guanguans\Notify\Foundation\Concerns\HasOptions;
use Guanguans\Notify\Foundation\Support\Arr;

/**
 * @template-implements \ArrayAccess<string, mixed>
 */
abstract class Message implements \ArrayAccess, Contracts\Message
{
    use AsJson;
    use AsPost;
    use Dumpable;
    use HasOptions;

    protected bool $ignoreUndefined = true;

    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    public function __debugInfo(): array
    {
        return $this->mergeDebugInfo([
            'httpMethod' => $this->toHttpMethod(),
            'httpUri' => $this->toHttpUri(),
            'httpOptions' => $this->toHttpOptions(),
        ]);
    }

    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * @param array|mixed $options
     *
     * @return static
     */
    public static function make($options = []): self
    {
        if (0 === \func_num_args()) {
            return new static($options);
        }

        $properties = (new \ReflectionClass(static::class))->getDefaultProperties();
        $defined = array_unique(array_merge($properties['defined'] ?? [], $properties['required'] ?? []));
        if (1 === \count($defined)) {
            return new static([current($defined) => $options]);
        }

        return new static($options);
    }

    protected function toJson(int $options = JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE): string
    {
        return json_encode($this->toPayload(), $options);
    }

    protected function toPayload(): array
    {
        return Arr::rejectRecursive(
            $this->getValidatedOptions(),
            static fn ($value): bool => [] === $value || null === $value
        );
    }
}
