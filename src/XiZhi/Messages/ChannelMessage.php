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

class ChannelMessage extends SingleMessage
{
    public function httpUri(): string
    {
        return 'https://xizhi.qqoq.net/<access-token>.channel';
    }
}
