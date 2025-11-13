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

namespace Guanguans\Notify\Foundation\Rectors;

use Guanguans\Notify\Foundation\Concerns\HasOptions;
use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use Guanguans\Notify\Foundation\Message;
use Guanguans\Notify\Foundation\Support\Str;
use Guanguans\Notify\Foundation\Support\Utils;
use Illuminate\Support\Collection;
use Illuminate\Support\Pluralizer;
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
use Rector\Contract\Rector\ConfigurableRectorInterface;
use Rector\PhpParser\Parser\SimplePhpParser;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\Exception\PoorDocumentationException;
use Symplify\RuleDocGenerator\Exception\ShouldNotHappenException;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Webmozart\Assert\Assert;

/**
 * @internal
 */
final class HasOptionsRector extends AbstractRector implements ConfigurableRectorInterface
{
    private array $classes = [
        Message::class,
    ];

    public function __construct(
        private DocBlockUpdater $docBlockUpdater,
        private PhpDocInfoFactory $phpDocInfoFactory,
        private SimplePhpParser $simplePhpParser,
    ) {}

    /**
     * @throws PoorDocumentationException
     * @throws ShouldNotHappenException
     */
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Has options doc comment',
            [
                new ConfiguredCodeSample(
                    <<<'CODE_SAMPLE'
                        class Message extends \Guanguans\Notify\Foundation\Message
                        {
                            protected array $defined = [
                                'title',
                                'content',
                            ];
                        }
                        CODE_SAMPLE,
                    <<<'CODE_SAMPLE'
                        /**
                         * @method self title($title)
                         * @method self content($content)
                         */
                        class Message extends \Guanguans\Notify\Foundation\Message
                        {
                            protected array $defined = [
                                'title',
                                'content',
                            ];
                        }
                        CODE_SAMPLE,
                    [Message::class => Message::class],
                ),
            ],
        );
    }

    /**
     * @throws \ReflectionException
     */
    public function configure(array $configuration): void
    {
        Assert::allClassExists($configuration);

        foreach ($configuration as $class) {
            if (!\array_key_exists(HasOptions::class, (new \ReflectionClass($class))->getTraits())) {
                throw new InvalidArgumentException(
                    \sprintf('The class [%s] must use trait [%s].', $class, HasOptions::class),
                );
            }
        }

        $this->classes = array_merge($this->classes, $configuration);
    }

    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     *
     * @throws \ReflectionException
     */
    public function refactor(Node $node): ?Node
    {
        if (!$this->isSubclassesOf($this->getName($node))) {
            return null;
        }

        $this->addMethodsOfListTypeOption($node);
        $this->sortProperties($node);
        $this->addPhpDocTagNodesOfMethod($node);

        return $node;
    }

    private function isSubclassesOf(string $object): bool
    {
        foreach ($this->classes as $class) {
            if (is_subclass_of($object, $class)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     * @noinspection D
     *
     * @throws \ReflectionException
     */
    private function addMethodsOfListTypeOption(Class_ $class): void
    {
        collect($this->allowedTypesFor($this->getName($class)))
            ->filter(
                static fn (array|string $allowedType): bool => \is_string($allowedType) && str_ends_with($allowedType, '[]')
            )
            ->keys()
            ->whenNotEmpty(function (Collection $options) use ($class): void {
                $property = collect($class->stmts)->first(
                    fn (Stmt $stmt): bool => $stmt instanceof Property && $this->isName($stmt, 'options')
                );

                if (!$property instanceof Property) {
                    $class->stmts[] = (new PropertyBuilder('options'))
                        ->makeProtected()
                        ->setType('array')
                        ->setDefault($options->mapWithKeys(static fn (string $option): array => [$option => []])->all())
                        ->getNode();

                    return;
                }

                $options->each(function (string $option) use ($property): void {
                    if (!($default = $property->props[0]->default) instanceof Array_) {
                        return;
                    }

                    $arrayItem = collect($default->items)->first(
                        fn (ArrayItem $arrayItem): bool => $this->isName($arrayItem->key, $option)
                    );

                    $arrayItem instanceof ArrayItem
                        ? $arrayItem->value = $this->nodeFactory->createArray([])
                        : $default->items[] = new ArrayItem(
                            $this->nodeFactory->createArray([]),
                            new String_($option)
                        );
                });
            })
            ->whenNotEmpty(function (Collection $options) use ($class): void {
                $options->each(function (string $option) use ($class): void {
                    if (
                        collect($class->stmts)->first(
                            fn (Stmt $stmt): bool => $stmt instanceof ClassMethod && $this->isName(
                                $stmt,
                                'add'.Str::studly(Pluralizer::singular($option))
                            )
                        ) instanceof ClassMethod
                    ) {
                        return;
                    }

                    /** @var list<Class_> $nodes */
                    $nodes = $this->simplePhpParser->parseString(
                        \sprintf(
                            <<<'code'
                                class Message
                                {
                                    public function add%s(array $%s): self
                                    {
                                        $this->options['%s'][] = $%s;

                                        return $this;
                                    }
                                }
                                code,
                            Str::studly($singularOption = Pluralizer::singular($option)),
                            $singularOption,
                            $option,
                            $singularOption,
                        )
                    );

                    $class->stmts[] = $nodes[0]->stmts[0];
                });
            });
    }

    private function sortProperties(Class_ $class): void
    {
        usort($class->stmts, static function (Stmt $a, Stmt $b): int {
            if (!$a instanceof Property || !$b instanceof Property) {
                return 0;
            }

            $rules = [
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

            return array_search($a->props[0]->name->name, $rules, true) <=> array_search(
                $b->props[0]->name->name,
                $rules,
                true,
            );
        });
    }

    /**
     * @throws \ReflectionException
     */
    private function addPhpDocTagNodesOfMethod(Class_ $node): void
    {
        if ([] === ($defined = $this->definedFor($class = $this->getName($node)))) {
            return;
        }

        $phpDocInfo = $this->phpDocInfoFactory->createEmpty($node);
        $allowedTypes = $this->allowedTypesFor($class);

        foreach ($defined as $option) {
            $phpDocInfo->addPhpDocTagNode($this->createPhpDocTagNodeOfMethod($option, $allowedTypes[$option] ?? null));
        }

        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($node);
    }

    /**
     * @throws \ReflectionException
     *
     * @return list<string>
     */
    private function definedFor(string $class): array
    {
        return collect(Utils::definedFor($class))
            ->filter(static fn (string $option): bool => !Str::is(['*@*'], $option))
            ->sort()
            ->all();
    }

    /**
     * @throws \ReflectionException
     *
     * @return array<string, mixed>
     */
    private function allowedTypesFor(string $class): array
    {
        return (new \ReflectionClass($class))->getDefaultProperties()['allowedTypes'] ?? [];
    }

    /**
     * @see \Symfony\Component\OptionsResolver\OptionsResolver::VALIDATION_FUNCTIONS
     *
     * @param list<string>|string $optionAllowedTypes
     */
    private function createPhpDocTagNodeOfMethod(string $option, null|array|string $optionAllowedTypes): PhpDocTagNode
    {
        $parameter = collect([
            collect((array) ($optionAllowedTypes ?? 'mixed'))
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
                )
                ->flatten()
                ->unique()
                ->sort()
                ->implode('|'),
            \sprintf('$%s', $camelCasedOption = Str::camel($option)),
        ])->filter()->implode(' ');

        return new PhpDocTagNode('@method', new GenericTagValueNode("self $camelCasedOption($parameter)"));
    }
}
