<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Telegram\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\Foundation\Credentials\TokenUriTemplateCredential;

class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

    public function toHttpUri(): string
    {
        return sprintf('https://api.telegram.org/bot{%s}/sendMessage', TokenUriTemplateCredential::TEMPLATE);
    }
}
