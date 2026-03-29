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
use Guanguans\Notify\Foundation\Support\Utils;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PhpParser\BuilderFactory;
use PhpParser\Comment;
use PhpParser\Node;
use PhpParser\Node\ArrayItem;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Nop;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\Trait_;
use PHPStan\PhpDocParser\Ast\PhpDoc\GenericTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\PhpParser\Node\BetterNodeFinder;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\PhpParser\Parser\SimplePhpParser;
use Rector\Rector\AbstractRector;

/**
 * @internal
 */
final class MessageRector extends AbstractRector
{
    public function __construct(
        private readonly BetterNodeFinder $betterNodeFinder,
        private readonly BuilderFactory $builderFactory,
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

        // TODO: symfony/options-resolver:>=8.0 Refactor `*Message::configureOptionsResolver()` to `*Message::nested() by MessageRector`.
        $this->updateAllowedTypesProperty($node);
        $this->updateMethodsOfListTypeOption($node);
        $this->updateNestedMethod($node);
        $this->updateDocCommentOfStmt($node);
        $this->updateDocCommentOfClass($node); // Must be last update doc comment.
        $this->sortPropertiesOfClass($node);

        return $node;
    }

    /**
     * @throws \ReflectionException
     *
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    private function updateAllowedTypesProperty(Class_ $classNode): void
    {
        collect($classNode->getMethods())
            ->filter(
                fn (ClassMethod $classMethodNode): bool => 1 === \count($classMethodNode->params)
                    && str_starts_with($this->getName($classMethodNode), 'add')
            )
            ->mapWithKeys(fn (ClassMethod $classMethodNode): array => [
                $this->valueResolver->getValue($classMethodNode->stmts[0]->expr->var->var->dim) => $this->getName(
                    $classMethodNode->params[0]->type
                ).'[]',
            ])
            ->whenNotEmpty(function (Collection $allowedTypes) use ($classNode): void {
                $allowedTypesPropertyNode = collect($classNode->stmts)->first(
                    fn (Stmt $stmtNode): bool => $stmtNode instanceof Property && $this->isName($stmtNode, 'allowedTypes')
                );

                if (
                    !$allowedTypesPropertyNode instanceof Property
                    || !($defaultNode = $allowedTypesPropertyNode->props[0]->default) instanceof Array_
                ) {
                    $propertyNode = $this
                        ->builderFactory
                        ->property('allowedTypes')
                        ->makeProtected()
                        ->setType('array')
                        ->setDefault($arrayNode = $this->nodeFactory->createArray($allowedTypes->all()))
                        ->getNode();
                    collect($arrayNode->items)->each(static fn (ArrayItem $arrayItemNode) => $arrayItemNode->setAttribute(
                        AttributeKey::COMMENTS,
                        [new Comment('')]
                    ));
                    array_splice(
                        $classNode->stmts,
                        (int) collect($classNode->stmts)->search(static fn (Stmt $stmtNode): bool => $stmtNode instanceof Property, true),
                        0,
                        [new Nop, $propertyNode]
                    );

                    return;
                }

                $allowedTypes->diffAssoc($this->valueResolver->getValue($defaultNode))->each(
                    function (string $allowedType, string $option) use ($defaultNode): void {
                        $arrayItemNode = collect($defaultNode->items)->first(
                            fn (ArrayItem $arrayItemNode): bool => (string) $this->valueResolver->getValue($arrayItemNode->key) === $option,
                        );

                        $arrayItemNode instanceof ArrayItem
                            ? $arrayItemNode->value->value = $allowedType
                            : $defaultNode->items[] = new ArrayItem(
                                new String_($allowedType),
                                new String_($option),
                                attributes: [AttributeKey::COMMENTS => [new Comment('')]]
                            );
                    }
                );
            });
    }

    /**
     * @throws \ReflectionException
     *
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
                    $propertyNode = $this
                        ->builderFactory
                        ->property('options')
                        ->makeProtected()
                        ->setType('array')
                        ->setDefault($arrayNode = $this->nodeFactory->createArray($allowedTypes->map(static fn (): array => [])->all()))
                        ->getNode();
                    collect($arrayNode->items)->each(static fn (ArrayItem $arrayItemNode) => $arrayItemNode->setAttribute(
                        AttributeKey::COMMENTS,
                        [new Comment('')]
                    ));
                    array_splice(
                        $classNode->stmts,
                        (int) collect($classNode->stmts)->search(static fn (Stmt $stmtNode): bool => $stmtNode instanceof Property, true),
                        0,
                        [new Nop, $propertyNode]
                    );

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
                        : $defaultNode->items[] = new ArrayItem(
                            $emptyArrayNode,
                            new String_($option),
                            attributes: [AttributeKey::COMMENTS => [new Comment('')]]
                        );
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
                                %spublic function add%s(%s $%s): self
                                {
                                    $this->options['%s'][] = $%s;

                                    return $this;
                                }
                            }
                            PHP,
                        (new \ReflectionClass($this->getName($classNode)))->isAbstract() ? 'final ' : ' ',
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

    private function updateDocCommentOfStmt(Class_ $classNode): void
    {
        $traitNode = $this->betterNodeFinder->findFirstInstanceOf(
            $this->simplePhpParser->parseFile(__DIR__.'/../Concerns/HasOptions.php'),
            Trait_::class
        );

        collect($classNode->stmts)->each(function (Stmt $stmtNode) use ($traitNode): void {
            $stmtName = $this->getName($stmtNode);

            $traitStmtNode = collect($traitNode->stmts)->first(
                fn (Stmt $traitStmtNode): bool => $traitStmtNode instanceof ($stmtNode::class)
                    && $this->isName($traitStmtNode, $stmtName)
            );

            if ($traitStmtNode instanceof Stmt && ($docComment = $traitStmtNode->getDocComment())) {
                $stmtNode->setDocComment($docComment);
            }
        });
    }

    /**
     * @throws \ReflectionException
     */
    private function updateDocCommentOfClass(Class_ $classNode): void
    {
        $class = $this->getName($classNode);
        $allowedTypes = (new \ReflectionClass($class))->getDefaultProperties()['allowedTypes'] ?? [];
        $phpDocInfo = $this->phpDocInfoFactory->createEmpty($classNode);

        collect(Utils::definedFor($class))
            ->filter(static fn (string $option): bool => !str($option)->is(['*@*']))
            ->sort()
            ->each(fn (string $option) => $phpDocInfo->addPhpDocTagNode(
                $this->createPhpDocTagNodeOfMethod($option, $allowedTypes)
            ))
            ->whenNotEmpty(fn () => $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($classNode));
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

    private function sortPropertiesOfClass(Class_ $classNode): void
    {
        usort($classNode->stmts, function (Stmt $aStmtNode, Stmt $bStmtNode): int {
            if (!$aStmtNode instanceof Property || !$bStmtNode instanceof Property) {
                return 0;
            }

            $sortRules = [
                'defaults', 'required', 'defined', 'ignoreUndefined', 'deprecated',
                'allowedValues', 'allowedTypes', 'infos', 'options',
            ];

            return array_search($this->getName($aStmtNode), $sortRules, true) <=> array_search(
                $this->getName($bStmtNode),
                $sortRules,
                true,
            );
        });
    }

    private function updateNestedMethod(Class_ $classNode): void
    {
        $configureMethod = collect($classNode->getMethods())
            ->first(fn (ClassMethod $classMethod): bool => $this->isName($classMethod, 'configureOptionsResolver'));

        if (!$configureMethod instanceof ClassMethod || [] === $configureMethod->params) {
            return;
        }

        $resolverVar = $configureMethod->params[0]->var;
        $resolverVarName = $resolverVar instanceof Node\Expr\Variable && \is_string($resolverVar->name)
            ? $resolverVar->name
            : null;

        if (null === $resolverVarName) {
            return;
        }

        $migrated = [];

        foreach ($configureMethod->stmts ?? [] as $index => $stmt) {
            if (!$stmt instanceof Stmt\Expression || !$stmt->expr instanceof Node\Expr\MethodCall) {
                continue;
            }

            $calls = $this->flattenRootMethodCalls($stmt->expr, $resolverVarName);

            if ([] === $calls) {
                continue;
            }

            foreach ($calls as $call) {
                if (
                    !$call->name instanceof Node\Identifier
                    || 'setOptions' !== $call->name->toString()
                    || !isset($call->args[0], $call->args[1])
                ) {
                    continue;
                }

                $keyNode = $call->args[0]->value;
                $key = $keyNode instanceof String_ ? $keyNode->value : $this->valueResolver->getValue($keyNode);

                if (!\is_string($key)) {
                    continue;
                }

                // 只迁移顶层 setOptions(key, closure)
                $migrated[$key] = clone $call->args[1]->value;
            }

            // 从 configureOptionsResolver 中删除顶层 setOptions 调用
            if ($this->removeTopLevelSetOptionsFromStmt($stmt, $resolverVarName)) {
                unset($configureMethod->stmts[$index]);
            }
        }

        if (null !== $configureMethod->stmts) {
            $configureMethod->stmts = array_values($configureMethod->stmts);
        }

        if ([] === $migrated) {
            return;
        }

        if ([] === ($configureMethod->stmts ?? [])) {
            $classNode->stmts = array_values(array_filter(
                $classNode->stmts,
                static fn (Stmt $stmt): bool => $stmt !== $configureMethod
            ));
        }

        $nestedMethod = $this->findOrCreateNestedMethod($classNode);
        $arrayNode = $this->ensureNestedReturnArray($nestedMethod);

        foreach ($migrated as $key => $valueExpr) {
            $existing = collect($arrayNode->items)->first(
                fn (?ArrayItem $item): bool => $item instanceof ArrayItem
                    && $this->valueResolver->getValue($item->key) === $key
            );

            if ($existing instanceof ArrayItem) {
                $existing->value = $valueExpr;

                continue;
            }

            $arrayNode->items[] = new ArrayItem(
                $valueExpr,
                new String_($key),
                attributes: [AttributeKey::COMMENTS => [new Comment('')]]
            );
        }
    }

    /**
     * @return list<Node\Expr\MethodCall> root-first
     */
    private function flattenRootMethodCalls(Node\Expr\MethodCall $methodCall, string $rootVarName): array
    {
        $calls = [];
        $cursor = $methodCall;

        while ($cursor instanceof Node\Expr\MethodCall) {
            $calls[] = $cursor;
            $cursor = $cursor->var;
        }

        if (
            !$cursor instanceof Node\Expr\Variable
            || !\is_string($cursor->name)
            || $cursor->name !== $rootVarName
        ) {
            return [];
        }

        return array_reverse($calls);
    }

    private function removeTopLevelSetOptionsFromStmt(Stmt\Expression $stmt, string $rootVarName): bool
    {
        if (!$stmt->expr instanceof Node\Expr\MethodCall) {
            return false;
        }

        $calls = $this->flattenRootMethodCalls($stmt->expr, $rootVarName);

        if ([] === $calls) {
            return false;
        }

        $keptCalls = array_values(array_filter(
            $calls,
            static fn (Node\Expr\MethodCall $call): bool => !$call->name instanceof Node\Identifier
                || 'setOptions' !== $call->name->toString()
        ));

        if ([] === $keptCalls) {
            return true;
        }

        $expr = new Node\Expr\Variable($rootVarName);

        foreach ($keptCalls as $keptCall) {
            $expr = new Node\Expr\MethodCall($expr, $keptCall->name, $keptCall->args, $keptCall->getAttributes());
        }

        $stmt->expr = $expr;

        return false;
    }

    private function findOrCreateNestedMethod(Class_ $classNode): ClassMethod
    {
        $nestedMethod = collect($classNode->getMethods())
            ->first(fn (ClassMethod $classMethod): bool => $this->isName($classMethod, 'nested'));

        if ($nestedMethod instanceof ClassMethod) {
            return $nestedMethod;
        }

        $nestedMethod = $this->builderFactory
            ->method('nested')
            ->makeProtected()
            ->setReturnType('array')
            ->addStmt(new Stmt\Return_(new Array_([], [AttributeKey::KIND => Array_::KIND_SHORT])))
            ->getNode();

        $classNode->stmts[] = new Nop;
        $classNode->stmts[] = $nestedMethod;

        return $nestedMethod;
    }

    private function ensureNestedReturnArray(ClassMethod $nestedMethod): Array_
    {
        $returnStmt = $nestedMethod->stmts[0] ?? null;

        if (!$returnStmt instanceof Stmt\Return_ || !$returnStmt->expr instanceof Array_) {
            $nestedMethod->stmts = [new Stmt\Return_(new Array_([], [AttributeKey::KIND => Array_::KIND_SHORT]))];
            $returnStmt = $nestedMethod->stmts[0];
        }

        return $returnStmt->expr;
    }
}
