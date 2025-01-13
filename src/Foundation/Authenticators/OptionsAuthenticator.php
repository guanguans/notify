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

namespace Guanguans\Notify\Foundation\Authenticators;

use Guanguans\Notify\Foundation\Support\Utils;

class OptionsAuthenticator extends NullAuthenticator
{
    private array $options;
    private bool $reversed;

    public function __construct(array $options, bool $reversed = false)
    {
        $this->options = $options;
        $this->reversed = $reversed;
    }

    public function applyToOptions(array $options): array
    {
        return $this->reversed
            ? Utils::mergeHttpOptions($this->options, $options)
            : Utils::mergeHttpOptions($options, $this->options);
    }
}
