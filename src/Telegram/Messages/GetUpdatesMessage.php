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

use Guanguans\Notify\Foundation\Credentials\TokenUriTemplateCredential;

class GetUpdatesMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'offset',
        'limit',
        'timeout',
        'allowed_updates',
    ];

    public function toHttpUri()
    {
        return sprintf('https://api.telegram.org/bot{%s}/getUpdates', TokenUriTemplateCredential::TEMPLATE);
    }
}
