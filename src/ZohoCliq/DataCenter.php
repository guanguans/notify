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

/**
 * @see https://www.zoho.com/cliq/help/restapi/v2/#cliq_rest_api
 * @see https://github.com/MarJose123/laravel-zoho-cliq-alert/blob/main/src/ZohoDataCenter.php
 *
 * @immutable
 *
 * @readonly
 */
enum DataCenter: string
{
    case AU = 'au';
    case CA = 'ca';
    case CN = 'cn';
    case EU = 'eu';
    case IN = 'in';
    case JP = 'jp';
    case SA = 'sa';
    case UK = 'uk';
    case US = 'us';

    public function toOauthBaseUri(): string
    {
        return str_replace('https://cliq.', 'https://accounts.', $this->toBaseUri());
    }

    public function toBaseUri(): string
    {
        return match ($this) {
            self::AU => 'https://cliq.zoho.com.au',
            self::CA => 'https://cliq.zohocloud.ca',
            self::CN => 'https://cliq.zoho.com.cn',
            self::EU => 'https://cliq.zoho.eu',
            self::IN => 'https://cliq.zoho.in',
            self::JP => 'https://cliq.zoho.jp',
            self::SA => 'https://cliq.zoho.sa',
            self::UK => 'https://cliq.zoho.uk',
            self::US => 'https://cliq.zoho.com',
        };
    }
}
