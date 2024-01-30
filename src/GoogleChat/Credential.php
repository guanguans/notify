<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\GoogleChat;

use Guanguans\Notify\Foundation\Credentials\AggregateCredential;
use Guanguans\Notify\Foundation\Credentials\QueryCredential;
use Guanguans\Notify\Foundation\Credentials\UriTemplateCredential;

class Credential extends AggregateCredential
{
    public function __construct(string $spaceId, string $key, string $token, ?string $threadKey = null)
    {
        $credentials = [
            new UriTemplateCredential(['spaceId' => $spaceId]),
            new QueryCredential('key', $key),
            new QueryCredential('token', $token),
        ];

        if ($threadKey) {
            $credentials[] = new QueryCredential('threadKey', $threadKey);
        }

        parent::__construct(...$credentials);
    }
}
