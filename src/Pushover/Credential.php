<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Pushover;

use Guanguans\Notify\Foundation\Credentials\AggregateCredential;
use Guanguans\Notify\Foundation\Credentials\QueryCredential;

class Credential extends AggregateCredential
{
    public function __construct(string $user, string $token)
    {
        parent::__construct(new QueryCredential('user', $user), new QueryCredential('token', $token));
    }
}
