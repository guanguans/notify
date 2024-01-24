<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Gitter;

class Client extends \Guanguans\Notify\Foundation\Client
{
    /**
     * @param AuthCredential|string $credential
     */
    public function __construct($credential, \GuzzleHttp\Client $httpClient = null)
    {
        if (! $credential instanceof AuthCredential) {
            $this->credential = new AuthCredential($credential);
        }

        parent::__construct($credential, $httpClient);
    }
}
