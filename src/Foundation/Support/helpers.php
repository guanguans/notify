<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

if (! function_exists('to_multipart')) {
    function to_multipart(array $form): array
    {
        /**
         * @param array-key $name
         * @param  array{
         *     name: string,
         *     contents: StreamInterface|resource|string,
         *     headers: array<string, string>,
         *     filename: string
         *     ...
         * }|StreamInterface|resource|scalar|null  $contents
         *
         * @return array{
         *     name: string,
         *     contents: resource|StreamInterface|string,
         *     headers: array<string, string>,
         *     filename: string
         * }[]
         */
        $partResolver = static function ($name, $contents) use (&$partResolver): array {
            if (! is_array($contents)) {
                // preg_match('/^.*:\/\/.*$/', $contents);
                is_string($contents) and is_file($contents) and $contents = Utils::tryFopen($contents, 'r');

                return [['name' => $name, 'contents' => $contents]];
            }

            if (
                isset($contents['name'], $contents['contents'])
                && [] === array_diff(array_keys($contents), ['name', 'contents', 'headers', 'filename'])
            ) {
                return [$contents];
            }

            $parts = [];
            foreach ($contents as $key => $value) {
                $key = "{$name}[$key]";

                $parts[] = is_array($value)
                    ? $partResolver($key, $value)
                    : [['name' => $key, 'contents' => $value]];
            }

            return array_merge([], ...$parts);
        };

        $parts = [];
        foreach ($form as $name => $contents) {
            $parts[] = $partResolver($name, $contents);
        }

        return array_merge([], ...$parts);
    }
}

if (! function_exists('configure_options')) {
    /**
     * Configuration options.
     */
    function configure_options(array $options, Closure $closure): array
    {
        $resolver = new OptionsResolver;

        $closure($resolver);

        return $resolver->resolve($options);
    }
}

if (! function_exists('base64_encode_file')) {
    /**
     * Base64 encode file content.
     */
    function base64_encode_file(string $file): string
    {
        return base64_encode(file_get_contents($file));
    }
}

if (! function_exists('tap')) {
    /**
     * Call the given Closure with the given value then return the value.
     *
     * @param mixed $value
     */
    function tap($value, ?callable $callback = null)
    {
        if (null === $callback) {
            return new class($value) {
                public $target;

                public function __construct($target)
                {
                    $this->target = $target;
                }

                public function __call($method, $parameters)
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

if (! function_exists('array_reduce_with_keys')) {
    /**
     * @param null|mixed $carry
     *
     * @return null|mixed
     */
    function array_reduce_with_keys(array $array, callable $callback, $carry = null)
    {
        foreach ($array as $key => $value) {
            $carry = $callback($carry, $value, $key);
        }

        return $carry;
    }
}
