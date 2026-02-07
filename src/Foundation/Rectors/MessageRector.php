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

use Guanguans\Notify\Foundation\Message;
use Guanguans\Notify\Foundation\Support\Str;
use Guanguans\Notify\Foundation\Support\Utils;
use Illuminate\Support\Collection;
use PhpParser\Builder\Property as PropertyBuilder;
use PhpParser\Node;
use PhpParser\Node\ArrayItem;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\PhpDoc\GenericTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\PhpParser\Parser\SimplePhpParser;
use Rector\Rector\AbstractRector;

/**
 * @internal
 */
final class MessageRector extends AbstractRector
{
    public function __construct(
        private readonly DocBlockUpdater $docBlockUpdater,
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly SimplePhpParser $simplePhpParser,
        private readonly ValueResolver $valueResolver,
    ) {}

    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param \PhpParser\Node\Stmt\Class_ $node
     *
     * @throws \ReflectionException
     */
    public function refactor(Node $node): ?Node
    {
        if (!is_subclass_of($this->getName($node), Message::class)) {
            return null;
        }

        $this->updateDocCommentOfClass($node);
        $this->updateAllowedTypesProperty($node);
        $this->updateMethodsOfListTypeOption($node);
        $this->sortPropertiesOfClass($node);

        return $node;
    }

    /**
     * @throws \ReflectionException
     */
    private function updateDocCommentOfClass(Class_ $classNode): void
    {
        $class = $this->getName($classNode);
        $allowedTypes = (new \ReflectionClass($class))->getDefaultProperties()['allowedTypes'] ?? [];
        $phpDocInfo = $this->phpDocInfoFactory->createEmpty($classNode);

        $this->definedFor($class)
            ->each(fn (string $option) => $phpDocInfo->addPhpDocTagNode(
                $this->createPhpDocTagNodeOfMethod($option, $allowedTypes)
            ))
            ->whenNotEmpty(fn () => $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($classNode));
    }

    /**
     * @param class-string<\Guanguans\Notify\Foundation\Message> $class
     *
     * @throws \ReflectionException
     */
    private function definedFor(string $class): Collection
    {
        return collect(Utils::definedFor($class))
            ->filter(static fn (string $option): bool => !str($option)->is(['*@*']))
            ->sort();
    }

    /**
     * @see \Symfony\Component\OptionsResolver\OptionsResolver::VALIDATION_FUNCTIONS
     *
     * @param array<string, list<string>|string> $allowedTypes
     */
    private function createPhpDocTagNodeOfMethod(string $option, array $allowedTypes): PhpDocTagNode
    {
        $parameter = collect([
            collect($allowedTypes[$option] ?? 'mixed')
                ->map(
                    static fn (string $type): array|string => match (
                        match (true) {
                            str_ends_with($type, '[]') => $type = 'array',
                            default => $type,
                        }
                    ) {
                        'boolean' => 'bool',
                        'integer', 'long' => 'int',
                        'double', 'real' => 'float',
                        'numeric' => ['int', 'float'],
                        'scalar', 'resource' => 'mixed',
                        'countable' => '\\'.\Countable::class,
                        default => $type,
                    }
                )->flatten()->unique()->sort()->implode('|'),
            \sprintf('$%s', $camelCasedOption = Str::camel($option)),
        ])->filter()->implode(' ');

        return new PhpDocTagNode('@method', new GenericTagValueNode("self $camelCasedOption($parameter)"));
    }

    private function updateAllowedTypesProperty(Class_ $classNode): void
    {
        collect($classNode->getMethods())
            ->filter(
                fn (ClassMethod $classMethodNode): bool => 1 === \count($classMethodNode->params)
                    && str_starts_with($this->getName($classMethodNode), 'add')
            )
            ->mapWithKeys(function (ClassMethod $classMethodNode): array {
                $option = str($this->getName($classMethodNode))->after('add')->snake()->plural()->toString();

                return [$option => $classMethodNode->params[0]->type->toString()];
            })
            ->dump();
    }

    /**
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    private function updateMethodsOfListTypeOption(Class_ $classNode): void
    {
        $allowedTypesPropertyNode = collect($classNode->stmts)->first(
            fn (Stmt $stmtNode): bool => $stmtNode instanceof Property && $this->isName($stmtNode, 'allowedTypes')
        );

        if (
            !$allowedTypesPropertyNode instanceof Property
            || !($defaultNode = $allowedTypesPropertyNode->props[0]->default) instanceof Array_
        ) {
            return;
        }

        collect($defaultNode->items)
            ->mapWithKeys(fn (ArrayItem $arrayItemNode): array => [
                (string) $this->valueResolver->getValue($arrayItemNode->key) => $this->valueResolver->getValue($arrayItemNode->value),
            ])
            ->filter(
                static fn (array|string $allowedType): bool => \is_string($allowedType) && str_ends_with($allowedType, '[]')
            )
            ->whenNotEmpty(function (Collection $allowedTypes) use ($classNode): void {
                $optionsPropertyNode = collect($classNode->stmts)->first(
                    fn (Stmt $stmtNode): bool => $stmtNode instanceof Property && $this->isName($stmtNode, 'options')
                );

                if (!$optionsPropertyNode instanceof Property) {
                    $classNode->stmts[] = (new PropertyBuilder('options'))
                        ->makeProtected()
                        ->setType('array')
                        ->setDefault($allowedTypes->map(static fn (): array => [])->all())
                        ->getNode();

                    return;
                }

                $allowedTypes->keys()->each(function (string $option) use ($optionsPropertyNode): void {
                    if (!($defaultNode = $optionsPropertyNode->props[0]->default) instanceof Array_) {
                        return;
                    }

                    $arrayItemNode = collect($defaultNode->items)->first(
                        fn (ArrayItem $arrayItemNode): bool => $this->valueResolver->getValue($arrayItemNode->key) === $option
                    );
                    $emptyArrayNode = $this->nodeFactory->createArray([]);
                    $arrayItemNode instanceof ArrayItem
                        ? $arrayItemNode->value = $emptyArrayNode
                        : $defaultNode->items[] = new ArrayItem($emptyArrayNode, new String_($option));
                });
            })
            ->each(function (string $allowedType, string $option) use ($classNode): void {
                $index = collect($classNode->stmts)->search(
                    fn (Stmt $stmtNode): bool => $stmtNode instanceof ClassMethod && $this->isName(
                        $stmtNode,
                        str($option)->singular()->studly()->prepend('add')->toString()
                    ),
                    true
                );

                if (false === $index) {
                    return;
                }

                /** @var list<Class_> $nodes */
                $nodes = $this->simplePhpParser->parseString(
                    \sprintf(
                        <<<'PHP'
                            class Message
                            {
                                /**
                                 * @api
                                 */
                                final public function add%s(%s $%s): self
                                {
                                    $this->options['%s'][] = $%s;

                                    return $this;
                                }
                            }
                            PHP,
                        str($option)->singular()->studly(),
                        str($allowedType)->beforeLast('[]'),
                        $camelSingularOption = str($option)->singular()->camel(),
                        $option,
                        $camelSingularOption,
                    )
                );

                if (!$this->nodeComparator->areNodesEqual($classNode->stmts[$index], $classMethodNode = $nodes[0]->stmts[0])) {
                    $classNode->stmts[$index] = $classMethodNode;
                }
            });
    }

    private function sortPropertiesOfClass(Class_ $classNode): void
    {
        usort($classNode->stmts, function (Stmt $aStmtNode, Stmt $bStmtNode): int {
            if (!$aStmtNode instanceof Property || !$bStmtNode instanceof Property) {
                return 0;
            }

            $sortRules = [
                'defaults',
                'required',
                'defined',
                'ignoreUndefined',
                'deprecated',
                'normalizers',
                'allowedValues',
                'allowedTypes',
                'infos',
                'options',
            ];

            return array_search($this->getName($aStmtNode), $sortRules, true) <=> array_search(
                $this->getName($bStmtNode),
                $sortRules,
                true,
            );
        });
    }
}
