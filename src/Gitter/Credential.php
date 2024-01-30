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

use Guanguans\Notify\Foundation\Credentials\AggregateCredential;
use Guanguans\Notify\Foundation\Credentials\TokenAuthCredential;
use Guanguans\Notify\Foundation\Credentials\UriTemplateCredential;

class Credential extends AggregateCredential
{
    public function __construct(string $roomId, string $token)
    {
        parent::__construct(
            new UriTemplateCredential(['roomId' => $roomId]),
            new TokenAuthCredential($token)
        );
    }
}
