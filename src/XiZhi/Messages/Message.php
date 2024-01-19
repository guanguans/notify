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
use Guanguans\Notify\Foundation\Concerns\AsSync;
use Guanguans\Notify\Foundation\HttpMessage;

abstract class Message extends HttpMessage
{
    use AsPost;
    use AsJson;
    use AsSync;

    protected array $defined = [
        'title',
        'content',
    ];

    public function __construct(string $title, string $content = null)
    {
        parent::__construct(['title' => $title, 'content' => $content]);
    }
}
