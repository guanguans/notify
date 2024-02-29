<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\IGot\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

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
    use AsJson;
    use AsPost;

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
        return 'https://push.hellyw.com/{token}';
    }
}
