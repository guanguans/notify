<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Telegram\Messages;

/**
 * @method self offset($offset)
 * @method self limit($limit)
 * @method self timeout($timeout)
 * @method self allowedUpdates(array $allowedUpdates)
 */
class GetUpdatesMessage extends Message
{
    protected array $defined = [
        'offset',
        'limit',
        'timeout',
        'allowed_updates',
    ];

    protected array $allowedTypes = [
        'allowed_updates' => 'array',
    ];

    public function toHttpUri(): string
    {
        return 'bot{token}/getUpdates';
    }
}
