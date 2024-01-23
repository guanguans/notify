<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\WeWorkGroupBot\Messages;

class MarkdownMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'content',
    ];

    public function __construct(string $content)
    {
        parent::__construct([
            'content' => $content,
        ]);
    }

    protected function type(): string
    {
        return 'markdown';
    }
}
