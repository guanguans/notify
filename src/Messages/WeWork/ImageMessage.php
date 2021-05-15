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

class ImageMessage extends Message
{
    protected $type = 'image';

    /**
     * @var string[]
     */
    protected $defined = [
        'imagePath',
    ];

    public function transformToRequestParams()
    {
        return [
            'msgtype' => $this->type,
            $this->type => [
                'base64' => base64_file($this->getOptions('imagePath')),
                'md5' => md5_file($this->getOptions('imagePath')),
            ],
        ];
    }
}
