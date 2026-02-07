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

namespace Guanguans\Notify\Foundation\Rectors;

use Guanguans\Notify\Foundation\Client;
use Guanguans\Notify\Foundation\Concerns\HasHttpClient;
use Guanguans\Notify\Foundation\Exceptions\LogicException;
use Guanguans\Notify\Foundation\Support\Utils;
use GuzzleHttp\Cookie\CookieJarInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use PhpParser\Node;
use PhpParser\Node\Stmt\Trait_;
use PHPStan\PhpDocParser\Ast\PhpDoc\GenericTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use Psr\Http\Message\StreamInterface;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Contract\Rector\ConfigurableRectorInterface;
use Rector\Rector\AbstractRector;
use Webmozart\Assert\Assert;

/**
 * @internal
 */
final class HasHttpClientDocCommentRector extends AbstractRector implements ConfigurableRectorInterface
{
    /** @var list<string> */
    private array $except = [
        '__*',
        'create',
        'hasHandler',
        'resolve',
        'getConfig',
    ];

    public function __construct(
        private readonly DocBlockUpdater $docBlockUpdater,
        private readonly PhpDocInfoFactory $phpDocInfoFactory
    ) {}

    public function getNodeTypes(): array
    {
        return [Trait_::class];
    }

    /**
     * @param \PhpParser\Node\Stmt\Trait_ $node
     */
    public function refactor(Node $node): ?Node
    {
        if (!$this->isName($node, HasHttpClient::class)) {
            return null;
        }

        $phpDocInfo = $this->phpDocInfoFactory->createEmpty($node);

        $this->addMixinDoc($phpDocInfo);
        $this->addRequestOptionsDoc($phpDocInfo);

        $phpDocInfo->addPhpDocTagNode($this->createEmptyDocTagNode());
        $phpDocInfo->addPhpDocTagNode(new PhpDocTagNode('@see', new GenericTagValueNode('\\'.HandlerStack::class)));
        $phpDocInfo->addPhpDocTagNode(new PhpDocTagNode('@see', new GenericTagValueNode('\\'.RequestOptions::class)));
        $phpDocInfo->addPhpDocTagNode($this->createEmptyDocTagNode());
        $phpDocInfo->addPhpDocTagNode(new PhpDocTagNode('@mixin', new GenericTagValueNode('\\'.Client::class)));

        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($node);

        return $node;
    }

    /**
     * @param list<string> $configuration
     */
    public function configure(array $configuration): void
    {
        Assert::allStringNotEmpty($configuration);
        $this->except = [...$this->except, ...$configuration];
    }

    private function addMixinDoc(PhpDocInfo $phpDocInfo): void
    {
        $reflectionMethods = array_filter(
            (new \ReflectionClass(HandlerStack::class))->getMethods(\ReflectionMethod::IS_PUBLIC),
            fn (\ReflectionMethod $reflectionMethod): bool => !Str::is($this->except, $reflectionMethod->getName()),
        );

        foreach ($reflectionMethods as $reflectionMethod) {
            $phpDocInfo->addPhpDocTagNode($this->createMethodPhpDocTagNode($reflectionMethod));
        }
    }

    /**
     * @see \Guanguans\Notify\Foundation\Support\Utils::httpOptionConstants()
     */
    private function addRequestOptionsDoc(PhpDocInfo $phpDocInfo): void
    {
        collect((new \ReflectionClass(RequestOptions::class))->getReflectionConstants())
            ->mapWithKeys(static fn (\ReflectionClassConstant $reflectionClassConstant): array => [
                (string) $reflectionClassConstant->getValue() => str($reflectionClassConstant->getDocComment())
                    ->match(
                        /** @lang PhpRegExp */
                        // '/:\s*\((.*?)\)/',
                        '/:\s*\((.*?)(?:,\s*default=.*?)?\)/',
                    )
                    ->whenEmpty(static fn (): Stringable => str('mixed'))
                    ->explode($delimiter = '|')
                    ->map(
                        static fn (string $type) => str($type)
                            ->replace(
                                ['StreamInterface', CookieJarInterface::class],
                                ['\\'.StreamInterface::class, '\\'.CookieJarInterface::class]
                            )
                            ->toString()
                    )
                    ->sort(static function (string $a, string $b): int {
                        if ('null' !== $a && 'null' === $b) {
                            return 1;
                        }

                        if ('null' === $a && 'null' !== $b) {
                            return -1;
                        }

                        return strcasecmp(ltrim($a, '\\'), ltrim($b, '\\'));
                    })
                    ->implode($delimiter),
            ])
            ->merge([
                'base_uri' => 'string',
                'curl' => 'array',
            ])
            ->tap(static function (Collection $collection): void {
                $asserter = static function (Collection $collection): never {
                    throw new LogicException(
                        \sprintf('The http option constants [%s] are different.', $collection->keys()->implode('、'))
                    );
                };

                $collection->diffKeys($constants = array_flip(Utils::httpOptionConstants()))->whenNotEmpty($asserter);
                collect($constants)->diffKeys($collection)->whenNotEmpty($asserter);
            })
            ->sortKeys()
            ->each(static function (string $type, string $name) use ($phpDocInfo): void {
                $phpDocInfo->addPhpDocTagNode(new PhpDocTagNode(
                    '@method',
                    new GenericTagValueNode(\sprintf('\\%s %s(%s $%s)', Client::class, $name = Str::camel($name), $type, $name))
                ));
            });
    }

    private function createEmptyDocTagNode(): PhpDocTagNode
    {
        return new PhpDocTagNode('', new GenericTagValueNode(''));
    }

    private function createMethodPhpDocTagNode(\ReflectionMethod $reflectionMethod): PhpDocTagNode
    {
        $parameters = collect($reflectionMethod->getParameters())
            ->map(
                static fn (\ReflectionParameter $reflectionParameter): Stringable => str((string) $reflectionParameter)
                    /** @lang PhpRegExp */
                    ->match('/\[ <(?:required|optional)> (.*?) ]/')
                    ->replace('NULL', 'null')
                    ->whenStartsWith('$', static fn (Stringable $stringable): Stringable => $stringable->prepend('mixed '))
            )
            ->implode(', ');

        return new PhpDocTagNode(
            '@method',
            new GenericTagValueNode(
                collect([
                    $reflectionMethod->isStatic() ? 'static' : null,
                    '\\'.Client::class,
                    $reflectionMethod->getName(),
                ])->filter()->implode(' ')."($parameters)"
            )
        );
    }
}
