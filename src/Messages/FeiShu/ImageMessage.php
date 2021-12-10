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

class ImageMessage extends Message
{
    protected $type = 'image';

    /**
     * @var string[]
     */
    protected $defined = [
        'image_key',
    ];

    public function __construct(string $imageKey)
    {
        parent::__construct([
            'image_key' => $imageKey,
        ]);
    }

    public function transformToRequestParams()
    {
        return [
            'msg_type' => $this->type,
            'content' => $this->getOption(),
        ];
    }
}
