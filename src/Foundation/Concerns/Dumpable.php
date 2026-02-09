<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation\Concerns;

use Symfony\Component\VarDumper\VarDumper;

trait Dumpable
{
    public function dd(mixed ...$args): void
    {
        $this->dump(...$args); // @codeCoverageIgnoreStart

        exit(1); // @codeCoverageIgnoreEnd
    }

    /**
     * @see \Illuminate\Support\Traits\Dumpable
     *
     * @noinspection ForgottenDebugOutputInspection
     * @noinspection DebugFunctionUsageInspection
     */
    public function dump(mixed ...$args): self
    {
        class_exists(VarDumper::class) ? dump($this, ...$args) : var_dump($this, ...$args);

        return $this;
    }

    /**
     * @param array<string, mixed> $debugInfo
     *
     * @return array<string, mixed>
     */
    protected function mergeDebugInfo(array $debugInfo): array
    {
        return class_exists(VarDumper::class) ? $debugInfo : get_object_vars($this) + $debugInfo;
    }
}
