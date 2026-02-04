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

namespace Guanguans\Notify\Telegram\Messages;

/**
 * @method self allowedUpdates(array $allowedUpdates)
 * @method self limit(mixed $limit)
 * @method self offset(mixed $offset)
 * @method self timeout(mixed $timeout)
 */
class GetUpdatesMessage extends Message
{
    /** @var list<string> */
    protected array $defined = [
        'offset',
        'limit',
        'timeout',
        'allowed_updates',
    ];

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'allowed_updates' => 'array',
    ];

    public function toHttpUri(): string
    {
        return 'bot{token}/getUpdates';
    }
}
