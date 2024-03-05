<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Slack;

/**
 * @see https://api.slack.com/messaging/webhooks
 *
 * ```
 * curl --location --request POST 'https://hooks.slack.com/services/TPU9A9/B038KNUC/6pKH3vfa3mjlUP' \
 * --header 'Content-Type: application/x-www-form-urlencoded' \
 * --data-urlencode 'payload={"text": "This is  text"}'
 * ```
 */
class Client extends \Guanguans\Notify\Foundation\Client
{
    public function __construct(Authenticator $authenticator)
    {
        parent::__construct($authenticator);
    }
}
