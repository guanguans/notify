<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\ZohoCliqWebHook;

/**
 * @see https://cliq.zoho.com/integrations/webhook-tokens
 * @see https://www.zoho.com/cliq/help/platform/webhook-tokens.html
 * @see https://www.zoho.com/cliq/help/restapi/v2/#Post_Message_Channel
 * @see https://www.zoho.com/cliq/help/restapi/v2/#create-thread
 * @see https://www.zoho.com/cliq/help/restapi/v2/#Message_Object
 * ```
 * curl --location 'https://cliq.zoho.com/api/v2/channelsbyname/announcements/message?zapikey=1001.4805235707f212af4b11be76483da614.d95141b05ae0550eabe503061a598' \
 * --header 'Content-Type: application/json' \
 * --data '{
 *     "text": "This is text."
 * }'
 * ```
 */
class Client extends \Guanguans\Notify\Foundation\Client
{
    public function __construct(Authenticator $authenticator)
    {
        parent::__construct($authenticator);
    }
}
