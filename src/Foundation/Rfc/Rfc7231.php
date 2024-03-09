<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Rfc;

/**
 * @see https://tools.ietf.org/html/rfc7231
 */
interface Rfc7231
{
    public const CONNECT = 'CONNECT';

    public const DELETE = 'DELETE';

    public const GET = 'GET';

    public const HEAD = 'HEAD';

    public const OPTIONS = 'OPTIONS';

    public const POST = 'POST';

    public const PUT = 'PUT';

    public const TRACE = 'TRACE';
}
