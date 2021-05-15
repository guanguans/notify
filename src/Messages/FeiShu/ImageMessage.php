<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\FeiShu;

class ImageMessage extends Message
{
    protected $type = 'image';

    /**
     * @var string[]
     */
    protected $defined = [
        'image_key',
        'secret',
    ];
}
