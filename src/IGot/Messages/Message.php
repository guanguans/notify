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

namespace Guanguans\Notify\IGot\Messages;

use Guanguans\Notify\Foundation\AbstractMessage;

/**
 * @method self automaticallyCopy(mixed $automaticallyCopy)
 * @method self content(mixed $content)
 * @method self copy(mixed $copy)
 * @method self detail(array $detail)
 * @method self title(mixed $title)
 * @method self urgent(mixed $urgent)
 * @method self url(mixed $url)
 */
class Message extends AbstractMessage
{
    /** @var list<string> */
    protected array $defined = [
        'title',
        'content',
        'url',
        'automaticallyCopy',
        'urgent',
        'copy',
        'detail',
    ];

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'detail' => 'array',
    ];

    public function toHttpUri(): string
    {
        return '{token}';
    }
}
