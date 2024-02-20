<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Push\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method self title($title)
 * @method self body($body)
 * @method self link($link)
 * @method self image($image)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $defined = [
        'title',
        'body',
        'link',
        'image',
    ];

    protected array $required = [
        'title',
        'body',
    ];

    public function toHttpUri(): string
    {
        return 'https://push.techulus.com/api/v1/notify/{token}';
    }
}
