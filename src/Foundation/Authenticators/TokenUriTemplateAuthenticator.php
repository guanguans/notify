<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Authenticators;

class TokenUriTemplateAuthenticator extends UriTemplateAuthenticator
{
    public function __construct(string $token)
    {
        parent::__construct(compact('token'));
    }
}
