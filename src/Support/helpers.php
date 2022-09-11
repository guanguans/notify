<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Guanguans\Notify\Proxy\HigherOrderTapProxy;
use Symfony\Component\OptionsResolver\OptionsResolver;

if (! function_exists('configure_options')) {
    /**
     * Configuration options.
     *
     * @param \Closure $closure
     */
    function configure_options(array $options, Closure $closure): array
    {
        $resolver = new OptionsResolver();

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
     * @param mixed         $value
     * @param callable|null $callback
     *
     * @return mixed
     */
    function tap($value, $callback = null)
    {
        if (is_null($callback)) {
            return new HigherOrderTapProxy($value);
        }

        $callback($value);

        return $value;
    }
}
