<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\IGot\Messages;

/**
 * @method self title($title)
 * @method self content($content)
 * @method self url($url)
 * @method self automaticallyCopy($automaticallyCopy)
 * @method self urgent($urgent)
 * @method self copy($copy)
 * @method self detail(array $detail)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    protected array $defined = [
        'title',
        'content',
        'url',
        'automaticallyCopy',
        'urgent',
        'copy',
        'detail',
    ];

    protected array $allowedTypes = [
        'detail' => 'array',
    ];

    public function toHttpUri(): string
    {
        return '{token}';
    }
}
