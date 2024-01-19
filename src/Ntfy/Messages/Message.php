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

class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;
    use AsJson;

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
     * @var string[]
     */
    protected $allowedTypes = [
        'tags' => 'array',
        'actions' => 'array',
    ];

    /**
     * @var array
     */
    protected $allowedValues = [
        'priority' => [5, 4, 3, 2, 1],
        'cache' => ['yes', 'no'],
        'firebase' => ['yes', 'no'],
    ];

    protected array $options = [
        'tags' => [],
        'actions' => [],
    ];

    public function httpUri()
    {
        return 'https://ntfy.sh';
    }
}
