<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\XiZhi\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;

/**
 * @method \Guanguans\Notify\XiZhi\Messages\Message title($title)
 * @method \Guanguans\Notify\XiZhi\Messages\Message content($content)
 */
abstract class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    protected array $defined = [
        'title',
        'content',
    ];

    public function __construct(string $title, ?string $content = null)
    {
        parent::__construct(['title' => $title, 'content' => $content]);
    }
}
