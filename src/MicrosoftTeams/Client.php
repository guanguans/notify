<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\MicrosoftTeams;

/**
 * @see https://learn.microsoft.com/zh-cn/outlook/actionable-messages/message-card-reference
 * @see https://learn.microsoft.com/zh-cn/microsoftteams/platform/webhooks-and-connectors/what-are-webhooks-and-connectors
 */
class Client extends \Guanguans\Notify\Foundation\Client
{
    public function __construct(Authenticator $authenticator)
    {
        parent::__construct($authenticator);
    }
}
