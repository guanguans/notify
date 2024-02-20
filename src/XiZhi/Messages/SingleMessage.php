<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\XiZhi\Messages;

/**
 * @method self title($title)
 * @method self content($content)
 */
class SingleMessage extends Message
{
    public function toHttpUri(): string
    {
        return 'https://xizhi.qqoq.net/{token}.send';
    }
}
