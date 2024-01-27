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

use Guanguans\Notify\Foundation\Message;
use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
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
class UpdateHasOptionsDocCommentRector extends AbstractRector implements ConfigurableRectorInterface
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

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Update has options doc comment',
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
                         * @method \Guanguans\Notify\Showdoc\Messages\Message title($title)
                         * @method \Guanguans\Notify\Showdoc\Messages\Message content($content)
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
                    ['\Guanguans\Notify\Foundation\Message::class']
                ),
            ]
        );
    }

    public function configure(array $configuration): void
    {
        Assert::allStringNotEmpty($configuration);
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
    public function refactor(Node $node)
    {
        /** @var class-string $class */
        $class = $node->getAttribute('scope')->getClassReflection()->getName();
        if (! $this->isSubclassOfs($class)) {
            return;
        }

        $defaultProperties = (new \ReflectionClass($class))->getDefaultProperties();
        $allowedTypes = $defaultProperties['allowedTypes'] ?? [];
        $defined = $defaultProperties['defined'] ?? [];
        if (empty($defined)) {
            return;
        }

        $node->setAttribute('comments', null);
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($node);
        foreach ($defined as $option) {
            $phpDocInfo->addPhpDocTagNode($this->createMethodPhpDocTagNode(
                $class,
                $option,
                $allowedTypes[$option] ?? []
            ));
        }

        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($node);

        return $node;
    }

    private function isSubclassOfs(string $object): bool
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
    private function createMethodPhpDocTagNode(string $class, string $option, $optionAllowedTypes): PhpDocTagNode
    {
        $option = Str::camel($option);
        $optionAllowedTypes = implode('|', (array) $optionAllowedTypes);
        $optionAllowedTypes = 'array' === $optionAllowedTypes ? $optionAllowedTypes.' ' : '';

        return new PhpDocTagNode('@method', new GenericTagValueNode("\\$class $option($optionAllowedTypes\$$option)"));
    }
}
