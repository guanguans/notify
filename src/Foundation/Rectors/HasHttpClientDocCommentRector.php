<?php

/** @noinspection PhpInternalEntityUsedInspection */
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
use PhpCsFixer\DocBlock\TypeExpression;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTypesOrderFixer;
use PhpParser\Node;
use PhpParser\Node\Stmt\Trait_;
use PHPStan\PhpDocParser\Ast\PhpDoc\GenericTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriFactoryInterface;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Rector\AbstractRector;

/**
 * @mixin \PhpCsFixer\Fixer\Phpdoc\PhpdocTypesOrderFixer
 *
 * @internal
 *
 * @method list<string> sortTypes(\PhpCsFixer\DocBlock\TypeExpression $typeExpression)
 */
final class HasHttpClientDocCommentRector extends AbstractRector
{
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

        $this->addHandlerStackDoc($phpDocInfo);
        $this->addRequestOptionsDoc($phpDocInfo);

        $phpDocInfo->addPhpDocTagNode($this->createEmptyPhpDocTagNode());
        $phpDocInfo->addPhpDocTagNode(new PhpDocTagNode('@see', new GenericTagValueNode('\\'.HandlerStack::class)));
        $phpDocInfo->addPhpDocTagNode(new PhpDocTagNode('@see', new GenericTagValueNode('\\'.RequestOptions::class)));
        $phpDocInfo->addPhpDocTagNode($this->createEmptyPhpDocTagNode());
        $phpDocInfo->addPhpDocTagNode(new PhpDocTagNode('@mixin', new GenericTagValueNode('\\'.Client::class)));

        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($node);

        return $node;
    }

    private function addHandlerStackDoc(PhpDocInfo $phpDocInfo): void
    {
        collect((new \ReflectionClass(HandlerStack::class))->getMethods(\ReflectionMethod::IS_PUBLIC))
            ->filter(static fn (\ReflectionMethod $reflectionMethod): bool => !str($reflectionMethod->getName())->is([
                '__*',
                'create',
                'hasHandler',
                'resolve',
                'getConfig',
            ]))
            ->each(fn (\ReflectionMethod $reflectionMethod) => $phpDocInfo->addPhpDocTagNode(
                $this->createHandlerStackMethodPhpDocTagNode($reflectionMethod)
            ));
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
                        // '/:\s*\((.*?)(?:,\s*default=.*?)?\)/',
                        // '~:\s*\(((?:(?!,\s*default=)[^()]|(?<nested>\((?:[^()]|(?&nested))*\)))*)(?:,\s*default=.*?)?\)~',
                        '~:\s*\(((?:(?!,\s*(?:\*\s*)?default\s*=)[^()]|(?<nested>\((?:[^()]|(?&nested))*\)))*)(?:,\s*(?:\*\s*)?default\s*=.*?)?\)~',
                    )
                    ->whenEmpty(static fn (): Stringable => str('mixed'))
                    ->replace([CookieJarInterface::class], '\\'.CookieJarInterface::class)
                    ->replace([RequestFactoryInterface::class], '\\'.RequestFactoryInterface::class)
                    ->replace([ResponseFactoryInterface::class], '\\'.ResponseFactoryInterface::class)
                    ->replace([StreamFactoryInterface::class], '\\'.StreamFactoryInterface::class)
                    ->replace([UriFactoryInterface::class], '\\'.UriFactoryInterface::class)
                    ->replace(['StreamInterface'], '\\'.StreamInterface::class)
                    ->replace(['"v4"|"v6"', "'http'|'https'"], 'string')
                    ->replace(['(callable&object)'], 'callable')
                    ->replace(['array-key'], 'int|string')
                    ->replace(['non-empty-array'], 'array')
                    ->replaceMatches('~callable\([^()]*\)(?::\s*[^,)\s]+(?:\|[^,)\s]+)*)?~', 'callable')
                    ->pipe(fn (Stringable $types): string => implode(
                        '|',
                        /** @see \PhpCsFixer\Fixer\Phpdoc\PhpdocTypesOrderFixer::applyFix() */
                        (fn (): array => $this->sortTypes(new TypeExpression($types->toString(), null, [])))
                            ->call(new PhpdocTypesOrderFixer)
                    )),
            ])
            ->merge(['base_uri' => 'string'])
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
            ->each(static fn (string $type, string $name) => $phpDocInfo->addPhpDocTagNode(new PhpDocTagNode(
                '@method',
                new GenericTagValueNode(\sprintf('\\%s %s(%s $%s)', Client::class, $name = Str::camel($name), $type, $name))
            )));
    }

    private function createEmptyPhpDocTagNode(): PhpDocTagNode
    {
        return new PhpDocTagNode('', new GenericTagValueNode(''));
    }

    private function createHandlerStackMethodPhpDocTagNode(\ReflectionMethod $reflectionMethod): PhpDocTagNode
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

        return new PhpDocTagNode('@method', new GenericTagValueNode(
            collect([
                $reflectionMethod->isStatic() ? 'static' : null,
                '\\'.Client::class,
                $reflectionMethod->getName(),
            ])->filter()->implode(' ')."($parameters)"
        ));
    }
}
