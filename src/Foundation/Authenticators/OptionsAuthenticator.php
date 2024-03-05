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

use Guanguans\Notify\Foundation\Support\Utils;

class OptionsAuthenticator extends NullAuthenticator
{
    private array $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function applyToOptions(array $options): array
    {
        return Utils::mergeHttpOptions($options, $this->options);
    }
}
