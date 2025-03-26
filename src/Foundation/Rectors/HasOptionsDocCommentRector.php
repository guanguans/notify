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
use PhpParser\Node;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\PhpDoc\GenericTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Contract\Rector\ConfigurableRectorInterface;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\Exception\PoorDocumentationException;
use Symplify\RuleDocGenerator\Exception\ShouldNotHappenException;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Webmozart\Assert\Assert;

/**
 * @internal
 */
final class HasOptionsDocCommentRector extends AbstractRector implements ConfigurableRectorInterface
{
    private array $classes = [
        Message::class,
    ];

    public function __construct(
        private DocBlockUpdater $docBlockUpdater,
        private PhpDocInfoFactory $phpDocInfoFactory
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
        /** @var class-string $class */
        $class = $this->getName($node);

        if (!$this->isSubclassesOf($class)) {
            return null;
        }

        $this->sortProperties($node);

        if ([] === ($defined = $this->definedFor($class))) {
            return $node;
        }

        $phpDocInfo = $this->phpDocInfoFactory->createEmpty($node);

        /** @var array<string, mixed> $allowedTypes */
        $allowedTypes = (new \ReflectionClass($class))->getDefaultProperties()['allowedTypes'] ?? [];

        foreach ($defined as $option) {
            $phpDocInfo->addPhpDocTagNode($this->createMethodPhpDocTagNode($option, $allowedTypes[$option] ?? null));
        }

        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($node);

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
     * @see \Symfony\Component\OptionsResolver\OptionsResolver::VALIDATION_FUNCTIONS
     *
     * @param list<string>|string $optionAllowedTypes
     */
    private function createMethodPhpDocTagNode(string $option, null|array|string $optionAllowedTypes): PhpDocTagNode
    {
        $parameter = collect([
            collect((array) ($optionAllowedTypes ?? 'mixed'))
                ->map(static fn (string $type): array|string => match ($type) {
                    'boolean' => 'bool',
                    'integer', 'long' => 'int',
                    'double', 'real' => 'float',
                    'numeric' => ['int', 'float'],
                    'scalar', 'resource' => 'mixed',
                    'countable' => '\\'.\Countable::class,
                    default => $type,
                })
                ->flatten()
                ->unique()
                ->sort()
                ->implode('|'),
            \sprintf('$%s', $camelCasedOption = Str::camel($option)),
        ])->filter()->implode(' ');

        return new PhpDocTagNode('@method', new GenericTagValueNode("self $camelCasedOption($parameter)"));
    }
}
