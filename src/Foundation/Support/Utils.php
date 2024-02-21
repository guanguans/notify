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

use Psr\Http\Message\StreamInterface;

class Utils
{
    /**
     * Convert a form array into a multipart array.
     */
    public static function toMultipart(array $form): array
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
            if (! \is_array($contents)) {
                // preg_match('/^.*:\/\/.*$/', $contents);
                \is_string($contents) and is_file($contents) and $contents = \GuzzleHttp\Psr7\Utils::tryFopen($contents, 'r');

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
}
