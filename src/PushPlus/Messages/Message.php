<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\PushPlus\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method self title($title)
 * @method self content($content)
 * @method self template($template)
 * @method self topic($topic)
 * @method self token($token)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $defined = [
        'title',
        'content',
        'template',
        'topic',
        'token',
    ];

    protected array $required = [
        'content',
    ];

    protected array $allowedValues = [
        'template' => ['html', 'json', 'cloudMonitor'],
    ];

    public function toHttpUri(): string
    {
        return 'https://www.pushplus.plus/send?token={token}';
    }
}
