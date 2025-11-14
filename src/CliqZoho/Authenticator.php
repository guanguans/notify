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

namespace Guanguans\Notify\CliqZoho;

use Guanguans\Notify\Foundation\Authenticators\BearerAuthenticator;

/**
 * ```
 * curl --location 'https://accounts.zoho.com/oauth/v2/token' \
 * --form 'client_id="1000.TTFROV098VVFG8NB686LR98TCDR"' \
 * --form 'client_secret="ffddfbd23c86a677e024003b4b8b8b7f2371ac6"' \
 * --form 'grant_type="client_credentials"' \
 * --form 'scope="ZohoCliq.Webhooks.CREATE,ZohoCliq.Channels.READ,ZohoCliq.Bots.READ,ZohoCliq.Chats.READ,ZohoCliq.Users.READ"'.
 *
 * curl --location 'https://cliq.zoho.com/api/v2/channels' \
 * --header 'Authorization: Zoho-oauthtoken 1000.80e9143983dcc190427cad7e8f029e25.cdc1c1043e5e7f0555fc14fc7faf3' \.
 *
 * curl --location 'https://cliq.zoho.com/api/v2/chats' \
 * --header 'Authorization: Zoho-oauthtoken 1000.80e9143983dcc190427cad7e8f029e25.cdc1c1043e5e7f0555fc14fc7faf3' \
 *
 * curl --location 'https://cliq.zoho.com/api/v2/users?limit=5' \
 * --header 'Authorization: Zoho-oauthtoken 1000.80e9143983dcc190427cad7e8f029e25.cdc1c1043e5e7f0555fc14fc7faf3' \
 * ```.
 */
class Authenticator extends BearerAuthenticator {}
