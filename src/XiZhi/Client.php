<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\XiZhi;

use Guanguans\Notify\Foundation\HttpClient;

class Client extends HttpClient
{
    /**
     * @param Credential|string $credential
     */
    public function __construct($credential, array $httpOptions = [])
    {
        if (! $credential instanceof Credential) {
            $credential = new Credential($credential);
        }

        parent::__construct($credential, $httpOptions);
    }
}
