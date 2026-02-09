<?php

/** @noinspection EfferentObjectCouplingInspection */
/** @noinspection PhpInternalEntityUsedInspection */
/** @noinspection PhpUnused */
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
use Illuminate\Support\Collection;
use Rector\Config\RectorConfig;
use Rector\DependencyInjection\LazyContainerFactory;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\PhpSubprocess;
use function Guanguans\RectorRules\Support\classes;

/**
 * @see https://github.com/laravel/framework/blob/12.x/src/Illuminate/Foundation/ComposerScripts.php
 *
 * @internal
 *
 * @property \Symfony\Component\Console\Output\ConsoleOutput $output
 *
 * @method void configureIO(InputInterface $input, OutputInterface $output)
 */
final class ComposerScripts
{
    /**
     * @see \PhpCsFixer\Hasher
     * @see \PhpCsFixer\Utils
     */
    private function __construct() {}

    /**
     * @throws \ErrorException
     * @throws \JsonException
     * @throws \ReflectionException
     *
     * @return int<0>|never-returns<1>
     *
     * @noinspection PhpDocSignatureInspection
     */
    public static function generateIdeJson(Event $event): int
    {
        self::requireAutoload($event);

        classes(static fn (string $class): bool => str($class)->is('Guanguans\Notify\*\Messages\*Message'))
            ->map(static fn (\ReflectionClass $reflectionClass, string $class): array => [
                'complete' => 'staticStrings',
                'condition' => [
                    [
                        'classFqn' => [$class],
                        'newClassFqn' => [$class],
                        'methodNames' => ['make'],
                        'parameters' => [1],
                        'place' => 'arrayKey',
                    ],
                ],
                'options' => [
                    'strings' => collect(Utils::definedFor($reflectionClass->getName()))->sort()->values()->all(),
                ],
            ])
            ->filter(static fn (array $completion): bool => (bool) $completion['options']['strings'])
            ->pipe(static fn (Collection $completions): Collection => collect([
                '$schema' => 'https://laravel-ide.com/schema/laravel-ide-v2.json',
                'completions' => $completions->values()->all(),
            ]))
            ->tap(static function (Collection $ide): void {
                file_put_contents(
                    __DIR__.'/../../../ide.json',
                    $ide->toJson(\JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES).\PHP_EOL,
                );
            });

        $event->getIO()->info('No errors');

        return 0;
    }

    /**
     * @return int<0>|never-returns<1>
     *
     * @noinspection PhpDocSignatureInspection
     */
    public static function platformLint(Event $event): int
    {
        self::requireAutoload($event);

        $platforms = collect(
            Finder::create()->directories()->in(__DIR__.'/../../../src/')->exclude('Foundation/')->depth(0)->sort(
                static fn (SplFileInfo $a, SplFileInfo $b): int => strcasecmp($a->getFilename(), $b->getFilename())
            )
        )->map(static fn (SplFileInfo $splFileInfo): string => $splFileInfo->getBasename());
        $platformsDescriptionContents = $platforms->implode('、');
        $platformsKeywordContents = $platforms
            ->map(static fn (string $platform): string => "        \"$platform\"")
            ->implode(",\n");
        $platformsLinkContents = $platforms
            ->map(static fn (string $platform): string => (
                \in_array($platform, ['Gitter', 'NowPush'], true)
                    ? "* [~~$platform~~](src/$platform/README.md)"
                    : "* [$platform](src/$platform/README.md)"
            ))
            ->implode("\n");

        file_put_contents(
            __DIR__.'/../../../tests.platforms',
            implode(\PHP_EOL, [$platformsDescriptionContents, $platformsKeywordContents, $platformsLinkContents])
        );

        $composerContents = file_get_contents(__DIR__.'/../../../composer.json');

        if (!str_contains($composerContents, $platformsDescriptionContents)) {
            $event->getIO()->error("The description of composer.json must contain: \n```\n$platformsDescriptionContents\n```");

            exit(1);
        }

        if (!str_contains($composerContents, $platformsKeywordContents)) {
            $event->getIO()->error("The keywords of composer.json must contain: \n```\n$platformsKeywordContents\n```");

            exit(1);
        }

        $readmeContents = file_get_contents(__DIR__.'/../../../README.md');

        if (!str_contains($readmeContents, $platformsDescriptionContents)) {
            $event->getIO()->error("The description of README.md must contain: \n```\n$platformsDescriptionContents\n```");

            exit(1);
        }

        if (!str_contains($readmeContents, $platformsLinkContents)) {
            $event->getIO()->error("The links of README.md must contain: \n```\n$platformsLinkContents\n```");

            exit(1);
        }

        $event->getIO()->info('No errors');

        return 0;
    }

    /**
     * @throws \JsonException
     */
    public static function generateGitleaksIgnore(Event $event): int
    {
        self::requireAutoload($event);

        $file = __DIR__.'/../../../gitleaks-baseline.json';

        if (!file_exists($file)) {
            (new PhpSubprocess([
                (new ExecutableFinder)->find($composer = 'composer', $composer),
                'run',
                'gitleaks:generate-baseline',
                '--ansi',
                '-v',
            ]))->mustRun(static fn (string $_, string $buffer) => $event->getIO()->writeRaw($buffer));
        }

        collect(json_decode(file_get_contents($file), true, 512, \JSON_THROW_ON_ERROR))
            ->pluck('Fingerprint')
            ->each(static fn (string $fingerprint) => $event->getIO()->info($fingerprint));

        $event->getIO()->info('');
        $event->getIO()->info('No errors');

        return 0;
    }

    public static function makeRectorConfig(): RectorConfig
    {
        static $rectorConfig;

        return $rectorConfig ??= (new LazyContainerFactory)->create();
    }

    /**
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public static function requireAutoload(Event $event, ?bool $enableDebugging = null): void
    {
        $enableDebugging ??= (new ArgvInput)->hasParameterOption('-vvv', true);
        $enableDebugging and $event->getIO()->enableDebugging(microtime(true));
        (fn () => $this->output->setVerbosity(OutputInterface::VERBOSITY_DEBUG))->call($event->getIO());

        require_once $event->getComposer()->getConfig()->get('vendor-dir').\DIRECTORY_SEPARATOR.'autoload.php';
    }

    public static function makeArgvInput(?array $argv = null, ?InputDefinition $inputDefinition = null): ArgvInput
    {
        static $argvInput;

        return $argvInput ??= new ArgvInput($argv, $inputDefinition);
    }

    /**
     * @see \Rector\Console\Style\SymfonyStyleFactory
     */
    public static function makeSymfonyStyle(?InputInterface $input = null, ?OutputInterface $output = null): SymfonyStyle
    {
        static $symfonyStyle;

        if (
            $symfonyStyle instanceof SymfonyStyle
            && (
                !$input instanceof InputInterface
                || (string) \Closure::bind(
                    static fn (SymfonyStyle $symfonyStyle): InputInterface => $symfonyStyle->input,
                    null,
                    SymfonyStyle::class
                )($symfonyStyle) === (string) $input
            )
            && (
                !$output instanceof OutputInterface
                || \Closure::bind(
                    static fn (SymfonyStyle $symfonyStyle): OutputInterface => $symfonyStyle->output,
                    null,
                    SymfonyStyle::class
                )($symfonyStyle) === $output
            )
        ) {
            return $symfonyStyle;
        }

        $input ??= new ArgvInput;
        $output ??= new ConsoleOutput;

        // to configure all -v, -vv, -vvv options without memory-lock to Application run() arguments
        (fn () => $this->configureIO($input, $output))->call(new Application);

        // --debug or --xdebug is called
        if ($input->hasParameterOption(['--debug', '--xdebug'], true)) {
            $output->setVerbosity(OutputInterface::VERBOSITY_DEBUG);
        }

        // disable output for testing
        if (self::isRunningInTesting()) {
            $output->setVerbosity(OutputInterface::VERBOSITY_QUIET);
        }

        return $symfonyStyle = new SymfonyStyle($input, $output);
    }

    public static function isRunningInTesting(): bool
    {
        return 'testing' === getenv('ENV');
    }
}
