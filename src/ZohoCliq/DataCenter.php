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

namespace Guanguans\Notify\ZohoCliq;

use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;

/**
 * @see https://www.zoho.com/cliq/help/restapi/v2/#cliq_rest_api
 * @see https://github.com/MarJose123/laravel-zoho-cliq-alert/blob/main/src/ZohoDataCenter.php
 *
 * @immutable
 *
 * @readonly
 */
class DataCenter implements \Stringable
{
    public const AU = 'au';
    public const CA = 'ca';
    public const CN = 'cn';
    public const EU = 'eu';
    public const IN = 'in';
    public const JP = 'jp';
    public const SA = 'sa';
    public const UK = 'uk';
    public const US = 'us';
    private const BASE_URI_MAP = [
        self::AU => 'https://cliq.zoho.com.au',
        self::CA => 'https://cliq.zohocloud.ca',
        self::CN => 'https://cliq.zoho.com.cn',
        self::EU => 'https://cliq.zoho.eu',
        self::IN => 'https://cliq.zoho.in',
        self::JP => 'https://cliq.zoho.jp',
        self::SA => 'https://cliq.zoho.sa',
        self::UK => 'https://cliq.zoho.uk',
        self::US => 'https://cliq.zoho.com',
    ];
    private string $value;

    public function __construct(?string $value = null)
    {
        if (!isset(self::BASE_URI_MAP[$this->value = $value ?? self::US])) {
            throw new InvalidArgumentException("Invalid data center [$this->value].");
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function toOauthBaseUri(): string
    {
        return str_replace('https://cliq.', 'https://accounts.', $this->toBaseUri());
    }

    public function toBaseUri(): string
    {
        return self::BASE_URI_MAP[$this->value];
    }
}
