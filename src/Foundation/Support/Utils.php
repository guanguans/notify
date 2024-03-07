<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Support;

use GuzzleHttp\RequestOptions;
use Psr\Http\Message\StreamInterface;

class Utils
{
    /**
     * Convert a form array into a multipart array.
     */
    public static function multipartFor(array $form): array
    {
        /**
         * @param array-key $name
         * @param  StreamInterface|resource|scalar|null|array{
         *     name: string,
         *     contents: StreamInterface|resource|string,
         *     headers: array<string, string>,
         *     filename: string,
         *     foo: mixed,
         *     bar: mixed,
         * }  $contents
         *
         * @return array{
         *     name: string,
         *     contents: resource|StreamInterface|string,
         *     headers: array<string, string>,
         *     filename: string
         * }[]
         */
        $partResolver = static function ($name, $contents) use (&$partResolver): array {
            if (! \is_array($contents)) {
                // filter_var($contents, FILTER_VALIDATE_URL); // url
                if (\is_string($contents) && is_file($contents)) {
                    $contents = \GuzzleHttp\Psr7\Utils::tryFopen($contents, 'r');
                }

                return [compact('name', 'contents')];
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

                $parts[] = \is_array($value)
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

    /**
     * Retrieves the HTTP options constants.
     *
     * @return array<string, string>
     */
    public static function getHttpOptionsConstants(): array
    {
        $constants = (new \ReflectionClass(RequestOptions::class))->getConstants() + [
            // '_CONDITIONAL' => '_conditional',
            'BASE_URI' => 'base_uri',
            'CURL' => 'curl',
        ];

        asort($constants);

        return $constants;
    }

    /**
     * Replace the given options with the current request options.
     */
    public static function mergeHttpOptions(array $originalOptions, array ...$options): array
    {
        return array_replace_recursive(
            array_merge_recursive($originalOptions, Arr::only($options, [
                RequestOptions::COOKIES,
                RequestOptions::FORM_PARAMS,
                RequestOptions::HEADERS,
                RequestOptions::JSON,
                RequestOptions::MULTIPART,
                RequestOptions::QUERY,
            ])),
            ...$options
        );
    }
}
