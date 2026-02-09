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

namespace Guanguans\Notify\YiFengChuanHua\Messages;

use Guanguans\Notify\Foundation\AbstractMessage;

/**
 * @method self body(mixed $body)
 * @method self delayMilliseconds(mixed $delayMilliseconds)
 * @method self head(mixed $head)
 * @method self url(mixed $url)
 */
class Message extends AbstractMessage
{
    /** @var list<string> */
    protected array $required = [
        // 'head',
    ];

    /** @var list<string> */
    protected array $defined = [
        'head',
        'body',
        'delayMilliseconds',
        'url',
    ];

    public function toHttpUri(): string
    {
        return 'services/push/send/{token}';
    }
}
