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

namespace Guanguans\Notify\Foundation\Support;

use Composer\Script\Event;
use Guanguans\Notify\Foundation\Message;
use Illuminate\Support\Collection;
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
     * @throws \JsonException
     * @throws \ReflectionException
     *
     * @return int<0, 0>
     *
     * @noinspection PhpDuplicatedCharacterInStrFunctionCallInspection
     * @noinspection PhpUnused
     */
    public static function generateIdeJson(Event $event): int
    {
        self::requireAutoload($event);

        collect(
            Finder::create()
                ->in(__DIR__.'/../../../src')
                ->exclude('Foundation')
                ->path('/Messages/')
                ->name([
                    'Message.php',
                    '*Message.php',
                ])
                ->sortByName()
                ->files()
        )
            ->mapWithKeys(static function (SplFileInfo $fileInfo): array {
                $class = \sprintf(
                    '\\Guanguans\\Notify\\%s',
                    str_replace('/', '\\', rtrim($fileInfo->getRelativePathname(), '.php'))
                );

                return [$class => new \ReflectionClass($class)];
            })
            ->filter(static fn (\ReflectionClass $reflectionClass): bool => $reflectionClass->isSubclassOf(Message::class))
            ->map(static function (\ReflectionClass $reflectionClass, string $class): array {
                $defined = Utils::definedFor($class);

                asort($defined);

                return array_values($defined);
            })
            ->map(static fn (array $defined, string $class): array => [
                'complete' => 'staticStrings',
                'condition' => [
                    [
                        'classFqn' => [
                            $class,
                        ],
                        'newClassFqn' => [
                            $class,
                        ],
                        'methodNames' => [
                            'make',
                        ],
                        'parameters' => [
                            1,
                        ],
                        'place' => 'arrayKey',
                    ],
                ],
                'options' => [
                    'strings' => $defined,
                ],
            ])
            ->pipe(static fn (Collection $completions): Collection => collect([
                '$schema' => 'https://laravel-ide.com/schema/laravel-ide-v2.json',
                'completions' => $completions->values()->all(),
            ]))
            ->tap(static function (Collection $ide): void {
                file_put_contents(
                    __DIR__.'/../../../ide.json',
                    json_encode($ide, \JSON_THROW_ON_ERROR | \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES)
                );
            });

        $event->getIO()->write('<info>Generate ide.json successfully.</info>');

        return 0;
    }

    /**
     * @return int<0, 0>
     *
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
            $event->getIO()->writeError("<error>The description of composer.json must contain: \n```\n$platformsDescriptionContents\n```</error>");

            exit(1);
        }

        if (!str_contains($composerContents, $platformsKeywordContents)) {
            $event->getIO()->writeError("<error>The keywords of composer.json must contain: \n```\n$platformsKeywordContents\n```</error>");

            exit(1);
        }

        $readmeContents = file_get_contents(__DIR__.'/../../../README.md');

        if (!str_contains($readmeContents, $platformsDescriptionContents)) {
            $event->getIO()->writeError("<error>The description of README.md must contain: \n```\n$platformsDescriptionContents\n```</error>");

            exit(1);
        }

        if (!str_contains($readmeContents, $platformsLinkContents)) {
            $event->getIO()->writeError("<error>The links of README.md must contain: \n```\n$platformsLinkContents\n```</error>");

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
