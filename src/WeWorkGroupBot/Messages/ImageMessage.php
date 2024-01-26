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

use GuzzleHttp\RequestOptions;

/**
 * @method \Guanguans\Notify\WeWorkGroupBot\Messages\ImageMessage imagePath($imagePath)
 */
class ImageMessage extends Message
{
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

    public function toHttpOptions(): array
    {
        return [
            RequestOptions::JSON => [
                'msgtype' => $this->type(),
                $this->type() => [
                    'base64' => base64_file($this->options['imagePath']),
                    'md5' => md5_file($this->options['imagePath']),
                ],
            ],
        ];
    }

    protected function type(): string
    {
        return 'image';
    }
}
