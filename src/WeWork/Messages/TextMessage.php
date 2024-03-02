<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\WeWork\Messages;

/**
 * @method self content($content)
 * @method self mentionedList(array $mentionedList)
 * @method self mentionedMobileList(array $mentionedMobileList)
 */
class TextMessage extends Message
{
    protected array $defined = [
        'content',
        'mentioned_list',
        'mentioned_mobile_list',
    ];

    protected array $allowedTypes = [
        'mentioned_list' => 'array',
        'mentioned_mobile_list' => 'array',
    ];

    protected function type(): string
    {
        return 'text';
    }
}
