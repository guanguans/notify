<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation\Support;

/**
 * @api
 */
class Str
{
    /**
     * The cache of snake-cased words.
     *
     * @var array<string, array<string, string>>
     */
    protected static array $snakeCache = [];

    /**
     * The cache of camel-cased words.
     *
     * @var array<string, string>
     */
    protected static array $camelCache = [];

    /**
     * The cache of studly-cased words.
     *
     * @var array<string, string>
     */
    protected static array $studlyCache = [];

    /**
     * Convert a value to camel case.
     */
    public static function pascal(string $value): string
    {
        return self::ucfirst(self::camel($value));
    }

    /**
     * Convert a value to camel case.
     */
    public static function camel(string $value): string
    {
        return self::$camelCache[$value] ?? (self::$camelCache[$value] = lcfirst(self::studly($value)));
    }

    /**
     * Convert a string to kebab case.
     */
    public static function kebab(string $value): string
    {
        return self::snake($value, '-');
    }

    /**
     * Convert a string to snake case.
     *
     * @noinspection CallableParameterUseCaseInTypeContextInspection
     */
    public static function snake(string $value, string $delimiter = '_'): string
    {
        $key = $value;

        if (isset(self::$snakeCache[$key][$delimiter])) {
            return self::$snakeCache[$key][$delimiter];
        }

        if (!ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));

            $value = self::lower(preg_replace('/(.)(?=[A-Z])/u', '$1'.$delimiter, (string) $value));
        }

        return self::$snakeCache[$key][$delimiter] = $value;
    }

    /**
     * Convert a value to studly caps case.
     */
    public static function studly(string $value): string
    {
        $key = $value;

        if (isset(self::$studlyCache[$key])) {
            return self::$studlyCache[$key];
        }

        $words = explode(' ', self::replace(['-', '_'], ' ', $value));

        $studlyWords = array_map(self::ucfirst(...), $words);

        return self::$studlyCache[$key] = implode('', $studlyWords);
    }

    /**
     * Determine if a given string matches a given pattern.
     *
     * @param iterable<string>|string $patterns
     *
     * @noinspection PhpDocSignatureInspection
     */
    public static function is(iterable|string $patterns, string $value): bool
    {
        if (!is_iterable($patterns)) {
            $patterns = [$patterns];
        }

        foreach ($patterns as $pattern) {
            $pattern = (string) $pattern;

            // If the given value is an exact match we can of course return true right
            // from the beginning. Otherwise, we will translate asterisks and do an
            // actual pattern match against the two strings to see if they match.
            if ($pattern === $value) {
                return true;
            }

            $pattern = preg_quote($pattern, '#');

            // Asterisks are translated into zero-or-more regular expression wildcards
            // to make it convenient to check if the strings starts with the given
            // pattern such as "library/*", making any string check convenient.
            $pattern = str_replace('\*', '.*', $pattern);

            if (1 === preg_match('#^'.$pattern.'\z#u', $value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Replace the given value in the given string.
     *
     * @param iterable<string>|string $search
     * @param iterable<string>|string $replace
     * @param iterable<string>|string $subject
     *
     * @return list<string>|string
     *
     * @noinspection PhpDocSignatureInspection
     */
    public static function replace(
        iterable|string $search,
        iterable|string $replace,
        iterable|string $subject,
        bool $caseSensitive = true
    ): array|string {
        if ($search instanceof \Traversable) {
            $search = iterator_to_array($search);
        }

        if ($replace instanceof \Traversable) {
            $replace = iterator_to_array($replace);
        }

        if ($subject instanceof \Traversable) {
            $subject = iterator_to_array($subject);
        }

        return $caseSensitive
            ? str_replace($search, $replace, $subject)
            : str_ireplace($search, $replace, $subject);
    }

    /**
     * Make a string's first character lowercase.
     */
    public static function lcfirst(string $string): string
    {
        return self::lower(self::substr($string, 0, 1)).self::substr($string, 1);
    }

    /**
     * Make a string's first character uppercase.
     */
    public static function ucfirst(string $string): string
    {
        return self::upper(self::substr($string, 0, 1)).self::substr($string, 1);
    }

    /**
     * Convert the given string to lower-case.
     */
    public static function lower(string $value): string
    {
        return mb_strtolower($value, 'UTF-8');
    }

    /**
     * Convert the given string to upper-case.
     */
    public static function upper(string $value): string
    {
        return mb_strtoupper($value, 'UTF-8');
    }

    /**
     * Returns the portion of the string specified by the start and length parameters.
     */
    public static function substr(string $string, int $start, ?int $length = null, string $encoding = 'UTF-8'): string
    {
        return mb_substr($string, $start, $length, $encoding);
    }

    /**
     * Remove all strings from the casing caches.
     */
    public static function flushCache(): void
    {
        self::$snakeCache = [];
        self::$camelCache = [];
        self::$studlyCache = [];
    }
}
