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

namespace Guanguans\Notify\NotifyX\Messages;

/**
 * @method self content(mixed $content)
 * @method self description(mixed $description)
 * @method self team(mixed $team)
 * @method self title(mixed $title)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    /** @var list<string> */
    protected array $required = [
        // 'title',
        // 'content',
    ];

    /** @var list<string> */
    protected array $defined = [
        'title',
        'content',
        'description',
        'team',
    ];

    public function toHttpUri(): string
    {
        return 'api/v1/send/{token}';
    }
}
