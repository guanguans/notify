<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Support;

use Guanguans\Notify\Foundation\Traits\HasHttpClient;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use PhpParser\Node;
use PhpParser\Node\Stmt\Trait_;
use PHPStan\PhpDocParser\Ast\PhpDoc\GenericTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Contract\Rector\ConfigurableRectorInterface;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Webmozart\Assert\Assert;

/**
 * @see \Rector\PHPUnit\CodeQuality\Rector\Class_\AddSeeTestAnnotationRector
 */
class UpdateHasHttpClientDocCommentRector extends AbstractRector implements ConfigurableRectorInterface
{
    private const MAIN_CLASS = \Guanguans\Notify\Foundation\Client::class;
    private const TRAIT = HasHttpClient::class;

    private array $except = [
        '__*',
        'create',
        'hasHandler',
        'resolve',
    ];

    private array $mixins = [
        HandlerStack::class,
        Client::class,
    ];

    private DocBlockUpdater $docBlockUpdater;
    private PhpDocInfoFactory $phpDocInfoFactory;

    public function __construct(DocBlockUpdater $docBlockUpdater, PhpDocInfoFactory $phpDocInfoFactory)
    {
        $this->except = array_merge($this->except, array_map(
            static fn (\ReflectionMethod $reflectionMethod) => $reflectionMethod->getName(),
            (new \ReflectionClass(self::MAIN_CLASS))->getMethods(\ReflectionMethod::IS_PUBLIC)
        ));
        $this->docBlockUpdater = $docBlockUpdater;
        $this->phpDocInfoFactory = $phpDocInfoFactory;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Update has http client doc comment',
            [
                new ConfiguredCodeSample(
                    <<<'CODE_SAMPLE'
                        trait HasHttpClient {}
                        CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
                        /**
                         * ...
                         * @method self setHandler(callable $handler)
                         * @method self hasHandler()
                         * ...
                         *
                         * @mixin \Guanguans\Notify\Foundation\Client
                         */
                        trait HasHttpClient {}
                        CODE_SAMPLE
                    ,
                    ['__*']
                ),
            ]
        );
    }

    public function configure(array $configuration): void
    {
        Assert::allStringNotEmpty($configuration);
        $this->except = array_merge($this->except, $configuration);
    }

    public function getNodeTypes(): array
    {
        return [Trait_::class];
    }

    /**
     * @param Trait_ $node
     *
     * @throws \ReflectionException
     */
    public function refactor(Node $node)
    {
        /** @var class-string $trait */
        $trait = $node->getAttribute('scope')->getClassReflection()->getName();
        if (self::TRAIT !== $trait) {
            return;
        }

        $node->setAttribute('comments', null);

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($node);
        foreach ($this->mixins as $mixin) {
            $reflectionMethods = array_filter(
                (new \ReflectionClass($mixin))->getMethods(\ReflectionMethod::IS_PUBLIC),
                fn (\ReflectionMethod $reflectionMethod) => ! Str::is($this->except, $reflectionMethod->getName())
            );

            foreach ($reflectionMethods as $reflectionMethod) {
                $phpDocInfo->addPhpDocTagNode($this->createMethodPhpDocTagNode($reflectionMethod));
            }
        }

        $phpDocInfo->addPhpDocTagNode(new PhpDocTagNode('', new GenericTagValueNode('')));
        $phpDocInfo->addPhpDocTagNode(new PhpDocTagNode('@mixin', new GenericTagValueNode('\\'.self::MAIN_CLASS)));

        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($node);

        return $node;
    }

    private function createMethodPhpDocTagNode(\ReflectionMethod $reflectionMethod): PhpDocTagNode
    {
        $static = $reflectionMethod->isStatic() ? 'static ' : '';

        $name = $reflectionMethod->getName();

        $parameters = rtrim(
            array_reduce(
                $reflectionMethod->getParameters(),
                static function (string $carry, \ReflectionParameter $reflectionParameter) {
                    if ($reflectionParameter->hasType()) {
                        /** @noinspection PhpVoidFunctionResultUsedInspection */
                        $type = $reflectionParameter->getType();
                        \assert($type instanceof \ReflectionNamedType);
                        $type->isBuiltin() or $carry .= '\\';
                        $carry .= $type->getName().' ';
                    }

                    $carry .= '$'.$reflectionParameter->getName();

                    if ($reflectionParameter->isDefaultValueAvailable()) {
                        $defaultValue = $reflectionParameter->getDefaultValue();

                        /** @noinspection DebugFunctionUsageInspection */
                        $export = var_export($defaultValue, true);
                        null === $defaultValue and $export = 'null';
                        [] === $defaultValue and $export = '[]';

                        $carry .= ' = '.$export;
                    }

                    return $carry.', ';
                },
                ''
            ),
            ', '
        );

        return new PhpDocTagNode('@method', new GenericTagValueNode("{$static}self $name($parameters)"));
    }
}
