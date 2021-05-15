<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\WeWork;

use Guanguans\Notify\Messages\Message;

class MarkdownMessage extends Message
{
    protected $type = 'markdown';

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

    public function transformToRequestParams()
    {
        return [
            'msgtype' => $this->type,
            $this->type => $this->getOptions(),
        ];
    }
}
