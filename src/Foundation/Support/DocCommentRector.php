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
 * @internal
 *
 * @see \Rector\PHPUnit\CodeQuality\Rector\Class_\AddSeeTestAnnotationRector
 */
class DocCommentRector extends AbstractRector implements ConfigurableRectorInterface
{
    private array $except = [
        'class',
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
            'Rename to psr name',
            [
                new ConfiguredCodeSample(
                    <<<'CODE_SAMPLE'
                        // lower snake
                        function functionName(){}
                        functionName();
                        call_user_func('functionName');
                        call_user_func_array('functionName');
                        function_exists('functionName');
                        CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
                        // lower snake
                        function function_name(){}
                        function_name();
                        call_user_func('function_name');
                        call_user_func_array('function_name');
                        function_exists('function_name');
                        CODE_SAMPLE
                    ,
                    ['exceptName']
                ),
            ]
        );
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
        if ($node->isAnonymous()) {
            return null;
        }

        /** @var class-string $class */
        $class = $node->getAttribute('scope')->getClassReflection()->getName();
        if (! is_subclass_of($class, Message::class)) {
            return null;
        }

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($node);
        $defined = (new \ReflectionClass($class))->getDefaultProperties()['defined'] ?? [];
        foreach ($defined as $property) {
            $phpDocInfo->addPhpDocTagNode($this->createMethodPhpDocTagNode($class, $property));
        }

        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($node);

        return $node;
    }

    private function createMethodPhpDocTagNode(string $class, string $defined): PhpDocTagNode
    {
        $defined = Str::camel($defined);

        return new PhpDocTagNode('@method', new GenericTagValueNode("\\$class $defined(\$$defined)"));
    }

    public function configure(array $configuration): void
    {
        Assert::allStringNotEmpty($configuration);
        $this->except = array_merge($this->except, $configuration);
    }
}
