<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\PushMe\Messages;

use Guanguans\Notify\Foundation\Concerns\AsNullUri;

/**
 * @method self content($content)
 * @method self date($date)
 * @method self pushKey($pushKey)
 * @method self tempKey($tempKey)
 * @method self title($title)
 * @method self type($type)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsNullUri;
    protected array $defined = [
        'push_key',
        'temp_key',
        'title',
        'content',
        'type',
        'date',
    ];
    protected array $allowedValues = [
        // 'type' => ['text', 'markdown', 'data', 'markdata', 'chart'],
    ];
}
