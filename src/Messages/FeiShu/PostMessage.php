<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\FeiShu;

use Guanguans\Notify\Messages\Message;

class PostMessage extends Message
{
    protected $type = 'post';

    /**
     * @var string[]
     */
    protected $defined = [
        'post',
    ];

    protected $allowedTypes = [
        'post' => 'array',
    ];

    /**
     * PostMessage constructor.
     */
    public function __construct(array $post = [])
    {
        parent::__construct([
            'post' => $post,
        ]);
    }

    public function transformToRequestParams()
    {
        return [
            'msg_type' => $this->type,
            'content' => $this->getOptions(),
        ];
    }
}
