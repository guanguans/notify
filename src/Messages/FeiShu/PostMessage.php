<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\FeiShu;

class PostMessage extends Message
{
    protected $type = 'post';

    /**
     * @var string[]
     */
    protected $defined = [
        'post',
        'secret',
    ];
}
