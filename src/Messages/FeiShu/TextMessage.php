<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\FeiShu;

class TextMessage extends Message
{
    protected $type = 'text';

    /**
     * @var string[]
     */
    protected $defined = [
        'text',
        'secret',
    ];
}
