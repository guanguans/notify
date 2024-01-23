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

use Guanguans\Notify\Foundation\NullCredential;

class Credential extends NullCredential
{
    private ?string $token;
    private ?string $user;

    public function __construct(string $token = null, string $user = null)
    {
        $this->token = $token;
        $this->user = $user;
    }

    public function applyToOptions(array $options): array
    {
        $options['multipart']['token'] = $this->token;
        $options['multipart']['user'] = $this->user;

        return $options;
    }
}
