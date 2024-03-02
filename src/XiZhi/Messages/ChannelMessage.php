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
 * @method self type($type)
 * @method self date($date)
 * @method self time($time)
 */
class ChannelMessage extends Message
{
    public function toHttpUri(): string
    {
        return 'https://xizhi.qqoq.net/{token}.channel';
    }
}
