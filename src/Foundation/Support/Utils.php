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

use Composer\InstalledVersions;
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

    /**
     * @param array<string, scalar> $agents
     *
     * @noinspection NotOptimalIfConditionsInspection
     */
    public static function userAgent(array $agents = []): string
    {
        $defaults = [];

        if (class_exists(InstalledVersions::class)) {
            $defaults['notify'] = InstalledVersions::getPrettyVersion('guanguans/notify');
            $defaults['guzzle'] = InstalledVersions::getPrettyVersion('guzzlehttp/guzzle');
        }

        if (\extension_loaded('curl') && \function_exists('curl_version')) {
            $defaults['curl'] = (curl_version() ?: ['version' => 'unknown'])['version'];
        }

        if (\defined('PHP_VERSION')) {
            $defaults['PHP'] = PHP_VERSION;
        }

        if (\defined('HHVM_VERSION')) {
            /** @noinspection PhpUndefinedConstantInspection */
            $defaults['HHVM'] = HHVM_VERSION;
        }

        if (
            \function_exists('php_uname')
            && ! \in_array('php_uname', explode(',', \ini_get('disable_functions') ?: ''), true)
        ) {
            $defaults['OS'] = sprintf('%s(%s)', php_uname('s'), php_uname('r'));
        }

        $defaults = array_merge($defaults, $agents);

        return trim(implode(' ', array_map(
            static fn ($value, string $name): string => "$name/$value",
            $defaults,
            array_keys($defaults)
        )));
    }
}
