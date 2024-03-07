<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Support\Rectors;

use Guanguans\Notify\Foundation\Concerns\HasOptions;
use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use Guanguans\Notify\Foundation\Message;
use Guanguans\Notify\Foundation\Support\Str;
use PhpParser\Node;
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
class HasOptionsDocCommentRector extends AbstractRector implements ConfigurableRectorInterface
{
    private array $classes = [
        Message::class,
    ];

    private DocBlockUpdater $docBlockUpdater;

    private PhpDocInfoFactory $phpDocInfoFactory;

    public function __construct(DocBlockUpdater $docBlockUpdater, PhpDocInfoFactory $phpDocInfoFactory)
    {
        $this->docBlockUpdater = $docBlockUpdater;
        $this->phpDocInfoFactory = $phpDocInfoFactory;
    }

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
                        CODE_SAMPLE
                    ,
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
                        CODE_SAMPLE
                    ,
                    [Message::class]
                ),
            ]
        );
    }

    /**
     * @throws \ReflectionException
     */
    public function configure(array $configuration): void
    {
        Assert::allClassExists($configuration);

        foreach ($configuration as $class) {
            if (! \array_key_exists(HasOptions::class, (new \ReflectionClass($class))->getTraits())) {
                throw new InvalidArgumentException(
                    sprintf('The class [%s] must use trait [%s].', $class, HasOptions::class)
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
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function refactor(Node $node)
    {
        /** @var class-string $class */
        $class = $node->getAttribute('scope')->getClassReflection()->getName();
        if (! $this->isSubclassesOf($class)) {
            return;
        }

        // Sort properties
        usort($node->stmts, static function (Node\Stmt $a, Node\Stmt $b): int {
            if (! $a instanceof Property || ! $b instanceof Property) {
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
                true
            );
        });

        $defaultProperties = (new \ReflectionClass($class))->getDefaultProperties();
        $allowedTypes = $defaultProperties['allowedTypes'] ?? [];
        $defined = array_filter(
            array_unique(array_merge($defaultProperties['defined'] ?? [], $defaultProperties['required'] ?? [])),
            static fn (string $option): bool => ! Str::is(['*@*'], $option)
        );
        if ([] === $defined) {
            return;
        }

        $node->setAttribute('comments', []);

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($node);
        foreach ($defined as $option) {
            $phpDocInfo->addPhpDocTagNode(
                $this->createMethodPhpDocTagNode($option, $allowedTypes[$option] ?? [])
            );
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

    /**
     * @param array<string>|string $optionAllowedTypes
     */
    private function createMethodPhpDocTagNode(string $option, $optionAllowedTypes): PhpDocTagNode
    {
        $option = Str::camel($option);

        switch ((array) $optionAllowedTypes) {
            case ['bool']:
            case ['boolean']:
                $type = 'bool ';

                break;
            case ['array']:
                $type = 'array ';

                break;
            default:
                $type = '';

                break;
        }

        return new PhpDocTagNode('@method', new GenericTagValueNode("self $option($type\$$option)"));
    }
}