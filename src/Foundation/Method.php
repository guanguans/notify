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

namespace Guanguans\Notify\Foundation;

enum Method: string
{
    /**
     * @see https://tools.ietf.org/html/rfc7231
     */
    case CONNECT = 'CONNECT';
    case DELETE = 'DELETE';
    case GET = 'GET';
    case HEAD = 'HEAD';
    case OPTIONS = 'OPTIONS';
    case POST = 'POST';
    case PUT = 'PUT';
    case TRACE = 'TRACE';

    /**
     * @see https://tools.ietf.org/html/rfc5789
     */
    case PATCH = 'PATCH';
}
