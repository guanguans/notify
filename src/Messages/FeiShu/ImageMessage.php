<?php

declare(strict_types=1);

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
    /**
     * @var string
     */
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

    /**
     * @return array{msg_type: mixed, content: mixed[]}
     */
    public function transformToRequestParams(): array
    {
        return [
            'msg_type' => $this->type,
            'content' => $this->getOptions(),
        ];
    }
}
