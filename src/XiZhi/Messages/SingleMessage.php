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

/**
 * @method \Guanguans\Notify\XiZhi\Messages\SingleMessage title($title)
 * @method \Guanguans\Notify\XiZhi\Messages\SingleMessage content($content)
 */
class SingleMessage extends Message
{
    public function toHttpUri(): string
    {
        return sprintf('https://xizhi.qqoq.net/{%s}.send', Credential::TEMPLATE);
    }
}
