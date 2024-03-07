<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Concerns;

use Symfony\Component\VarDumper\VarDumper;

trait Dumpable
{
    /**
     * @codeCoverageIgnore
     */
    public function dd(...$args): void
    {
        $this->dump(...$args);

        exit(1);
    }

    /**
     * @psalm-suppress ForbiddenCode
     *
     * @noinspection ForgottenDebugOutputInspection
     * @noinspection DebugFunctionUsageInspection
     */
    public function dump(...$args): self
    {
        $args[] = $this;
        $varDumperExists = class_exists(VarDumper::class);

        foreach ($args as $arg) {
            $varDumperExists ? VarDumper::dump($arg) : var_dump($arg);
        }

        return $this;
    }

    private function mergeDebugInfo(array $debugInfo): array
    {
        return class_exists(VarDumper::class) ? $debugInfo : get_object_vars($this) + $debugInfo;
    }
}
