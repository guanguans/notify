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
use Symfony\Component\OptionsResolver\OptionsResolver;

if (! function_exists('to_multipart')) {
    /**
     * @noinspection SlowArrayOperationsInLoopInspection
     */
    function to_multipart(array $form): array
    {
        $normalizeMultipartField = function (string $name, $contents) use (&$normalizeMultipartField): array {
            $field = [];
            if (! is_array($contents)) {
                if (is_string($contents) && is_file($contents)) {
                    $contents = Utils::tryFopen($contents, 'r');
                }

                return [compact('name', 'contents')];
            }

            foreach ($contents as $key => $value) {
                $key = "{$name}[$key]";
                $field = array_merge(
                    $field,
                    is_array($value)
                        ? $normalizeMultipartField($key, $value)
                        : [['name' => $key, 'contents' => $value]]
                );
            }

            return $field;
        };

        $multipart = [];
        foreach ($form as $name => $contents) {
            $multipart = array_merge($multipart, $normalizeMultipartField($name, $contents));
        }

        return $multipart;
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

if (! function_exists('base64_file')) {
    /**
     * Base64 encode file content.
     */
    function base64_file(string $file): string
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
