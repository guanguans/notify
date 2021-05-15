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
        'image_path',
        'base64',
        'md5',
    ];

    public function getBase64File(string $imagePath)
    {
        return base64_encode(file_get_contents($imagePath));
    }

    public function getMd5File(string $imagePath)
    {
        return md5_file($imagePath);
    }

    public function transformToRequestParams()
    {
        return [
            'msgtype' => 'image',
            'image' => [
                'base64' => $this->getBase64File($this->options['image_path']),
                'md5' => $this->getMd5File($this->options['image_path']),
            ],
        ];
    }
}
