<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation\Support;

const MULTIPART_TRY_OPEN_FILE = 1 << 0;
const MULTIPART_TRY_OPEN_URL = 1 << 1;

if (!\function_exists('Guanguans\Notify\Foundation\Support\rescue')) {
    function rescue(callable $callback, ?callable $rescuer = null)
    {
        /** @phpstan-ignore-next-line  */
        set_error_handler(static function (
            int $errNo,
            string $errStr,
            string $errFile = '',
            int $errLine = 0
        ) use ($rescuer, &$result): void {
            $rescuer and $result = $rescuer($errNo, $errStr, $errFile, $errLine);
        });

        // set_exception_handler(static function (\Throwable $throwable) use ($rescuer, &$result): void {
        //     $rescuer and $result = $rescuer($throwable);
        // });

        try {
            $result = $callback();
        } catch (\Throwable $throwable) {
            $rescuer and $result = $rescuer($throwable);
        }

        restore_error_handler();

        return $result;
    }
}

if (!\function_exists('Guanguans\Notify\Foundation\Support\value')) {
    /**
     * Return the default value of the given value.
     */
    function value(mixed $value, mixed ...$args): mixed
    {
        return $value instanceof \Closure ? $value(...$args) : $value;
    }
}

if (!\function_exists('Guanguans\Notify\Foundation\Support\base64_encode_file')) {
    /**
     * Encodes a file to base64.
     */
    function base64_encode_file(string $file): string
    {
        return base64_encode(file_get_contents($file));
    }
}

if (!\function_exists('Guanguans\Notify\Foundation\Support\tap')) {
    /**
     * Call the given Closure with the given value then return the value.
     *
     * @see https://github.com/laravel/framework
     */
    function tap(mixed $value, ?callable $callback = null)
    {
        if (null === $callback) {
            return new class($value) {
                public function __construct(private object $target) {}

                public function __call(string $method, array $parameters): mixed
                {
                    $this->target->{$method}(...$parameters);

                    return $this->target;
                }
            };
        }

        $callback($value);

        return $value;
    }
}
