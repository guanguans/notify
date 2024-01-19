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

use Guanguans\Notify\XiZhi\Credential;

class SingleMessage extends Message
{
    public function httpUri(): string
    {
        return sprintf('https://xizhi.qqoq.net/%s.send', Credential::ACCESS_TOKEN_PLACEHOLDER);
    }
}
