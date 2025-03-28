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

namespace Guanguans\Notify\Foundation\Support;

use Composer\Script\Event;
use Rector\Config\RectorConfig;
use Rector\DependencyInjection\LazyContainerFactory;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * @see https://github.com/laravel/framework/blob/12.x/src/Illuminate/Foundation/ComposerScripts.php
 *
 * @internal
 */
final class ComposerScripts
{
    /**
     * @noinspection PhpUnused
     */
    public static function platformLint(Event $event): int
    {
        self::requireAutoload($event);

        $platforms = collect(
            Finder::create()
                ->in(__DIR__.'/../../../src')
                ->exclude('Foundation')
                ->depth(0)
                ->sort(
                    static fn (
                        SplFileInfo $a,
                        SplFileInfo $b
                    ): int => strtolower($a->getFilename()) <=> strtolower($b->getFilename())
                )
                ->directories()
        )
            ->map(static fn (SplFileInfo $splFileInfo): string => $splFileInfo->getBasename())
            ->values()
            ->all();

        $deprecatedPlatforms = [
            'Gitter',
            'NowPush',
        ];

        $platformsDescriptionContents = implode('、', $platforms);

        $platformsKeywordContents = trim(
            array_reduce(
                $platforms,
                static fn (string $carry, string $platform): string => $carry."        \"$platform\",\n",
                ''
            ),
            ",\n"
        );

        $platformsLinkContents = trim(
            array_reduce(
                $platforms,
                static fn (string $carry, string $platform): string => $carry.(
                    \in_array($platform, $deprecatedPlatforms, true)
                        ? "* [~~$platform~~](./src/$platform/README.md)\n"
                        : "* [$platform](./src/$platform/README.md)\n"
                ),
                ''
            ),
            "\n"
        );

        file_put_contents(
            __DIR__.'/../../../tests.platforms',
            implode(\PHP_EOL, [
                $platformsDescriptionContents,
                $platformsKeywordContents,
                $platformsLinkContents,
            ])
        );

        $composerContents = file_get_contents(__DIR__.'/../../../composer.json');

        if (!str_contains($composerContents, $platformsDescriptionContents)) {
            $event->getIO()->writeError("The description of composer.json must contain: \n```\n$platformsDescriptionContents\n```");

            exit(1);
        }

        if (!str_contains($composerContents, $platformsKeywordContents)) {
            $event->getIO()->writeError("The keywords of composer.json must contain: \n```\n$platformsKeywordContents\n```");

            exit(1);
        }

        $readmeContents = file_get_contents(__DIR__.'/../../../README.md');

        if (!str_contains($readmeContents, $platformsDescriptionContents)) {
            $event->getIO()->writeError("The description of README.md must contain: \n```\n$platformsDescriptionContents\n```");

            exit(1);
        }

        if (!str_contains($readmeContents, $platformsLinkContents)) {
            $event->getIO()->writeError("The links of README.md must contain: \n```\n$platformsLinkContents\n```");

            exit(1);
        }

        $event->getIO()->write('<info>Platforms lint successfully.</info>');

        return 0;
    }

    public static function makeRectorConfig(): RectorConfig
    {
        return (new LazyContainerFactory)->create();
    }

    private static function requireAutoload(Event $event): void
    {
        require_once $event->getComposer()->getConfig()->get('vendor-dir').'/autoload.php';
    }
}
