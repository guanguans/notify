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
    /**
     * @var string
     */
    protected $type = 'image';

    /**
     * @var string[]
     */
    protected $defined = [
        'imagePath',
    ];

    public function __construct(string $imagePath)
    {
        parent::__construct([
            'imagePath' => $imagePath,
        ]);
    }

    /**
     * @return array<int|string, mixed>
     */
    public function transformToRequestParams(): array
    {
        return [
            'msgtype' => $this->type,
            $this->type => [
                'base64' => base64_file($this->getOption('imagePath')),
                'md5' => md5_file($this->getOption('imagePath')),
            ],
        ];
    }
}
