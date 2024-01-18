<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\LarkGroupBot;

use Guanguans\Notify\Foundation\HttpClient;
use Psr\Http\Client\ClientInterface;

class Client extends HttpClient
{
    public function __construct(Credential $credential, ClientInterface $httpClient = null)
    {
        parent::__construct($credential, $httpClient);
    }
}
