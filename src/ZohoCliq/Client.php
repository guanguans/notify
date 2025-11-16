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

namespace Guanguans\Notify\ZohoCliq;

/**
 * @see https://accounts.zoho.com/developerconsole
 * @see https://www.zoho.com/cliq/help/restapi/v2/#authentication
 * @see https://www.zoho.com/cliq/help/restapi/v2/#Post_Message_Channel
 * @see https://www.zoho.com/cliq/help/restapi/v2/#Message_Object
 * @see https://github.com/Weble/ZohoClient
 * @see https://github.com/MarJose123/laravel-zoho-cliq-alert
 */
class Client extends \Guanguans\Notify\Foundation\Client
{
    public function __construct(Authenticator $authenticator)
    {
        parent::__construct($authenticator);
    }
}
