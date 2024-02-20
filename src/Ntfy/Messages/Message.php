<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Ntfy\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method self topic($topic)
 * @method self message($message)
 * @method self title($title)
 * @method self priority($priority)
 * @method self tags(array $tags)
 * @method self delay($delay)
 * @method self actions(array $actions)
 * @method self click($click)
 * @method self attach($attach)
 * @method self icon($icon)
 * @method self filename($filename)
 * @method self email($email)
 * @method self cache($cache)
 * @method self firebase($firebase)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $defined = [
        'topic',
        'message',
        'title',
        'priority',
        'tags',
        'delay',
        'actions',
        'click',
        'attach',
        'icon',
        'filename',
        'email',
        'cache',
        'firebase',
    ];

    protected array $required = [
        'topic',
    ];

    protected array $allowedTypes = [
        'tags' => 'array',
        'actions' => 'array',
    ];

    protected array $allowedValues = [
        'priority' => [5, 4, 3, 2, 1],
        'cache' => ['yes', 'no'],
        'firebase' => ['yes', 'no'],
    ];

    protected array $options = [
        'tags' => [],
        'actions' => [],
    ];

    public function toHttpUri(): string
    {
        return '';
    }
}
