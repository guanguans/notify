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
 * @method \Guanguans\Notify\Ntfy\Messages\Message topic($topic)
 * @method \Guanguans\Notify\Ntfy\Messages\Message message($message)
 * @method \Guanguans\Notify\Ntfy\Messages\Message title($title)
 * @method \Guanguans\Notify\Ntfy\Messages\Message priority($priority)
 * @method \Guanguans\Notify\Ntfy\Messages\Message tags(array $tags)
 * @method \Guanguans\Notify\Ntfy\Messages\Message delay($delay)
 * @method \Guanguans\Notify\Ntfy\Messages\Message actions(array $actions)
 * @method \Guanguans\Notify\Ntfy\Messages\Message click($click)
 * @method \Guanguans\Notify\Ntfy\Messages\Message attach($attach)
 * @method \Guanguans\Notify\Ntfy\Messages\Message icon($icon)
 * @method \Guanguans\Notify\Ntfy\Messages\Message filename($filename)
 * @method \Guanguans\Notify\Ntfy\Messages\Message email($email)
 * @method \Guanguans\Notify\Ntfy\Messages\Message cache($cache)
 * @method \Guanguans\Notify\Ntfy\Messages\Message firebase($firebase)
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

    protected $required = [
        'topic',
    ];

    /**
     * @var array<string>
     */
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

    public function toHttpUri()
    {
        return 'https://ntfy.sh';
    }
}
