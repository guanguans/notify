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

use PhpParser\Node;
use PhpParser\Node\Name;
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
class ToInternalExceptionRector extends AbstractRector implements ConfigurableRectorInterface
{
    private array $except = [
    ];

    /**
     * @throws PoorDocumentationException
     * @throws ShouldNotHappenException
     */
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'To internal exception',
            [
                new ConfiguredCodeSample(
                    <<<'CODE_SAMPLE'
                        throw new \InvalidArgumentException('on_headers must be callable');
                        CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
                        throw new \Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException('on_headers must be callable');
                        CODE_SAMPLE
                    ,
                    ['exceptionClassPattern']
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
        return [
            Name\FullyQualified::class,
        ];
    }

    /**
     * @param Node\Name\FullyQualified $node
     *
     * @throws \ReflectionException
     */
    public function refactor(Node $node)
    {
        if (
            Str::is($this->except, $node->toString())
            || str_starts_with($node->toString(), 'Guanguans\\Notify\\Foundation\\Exceptions\\')
            || ! str_ends_with($node->toString(), 'Exception')
        ) {
            return;
        }

        $internalExceptionClass = "\\Guanguans\\Notify\\Foundation\\Exceptions\\{$node->getLast()}";
        if (! class_exists($internalExceptionClass)) {
            $this->createInternalException($node);
        }

        return new Name($internalExceptionClass, $node->getAttributes());
    }

    /**
     * @throws \ReflectionException
     */
    private function createInternalException(Name\FullyQualified $node): void
    {
        $externalExceptionClass = $node->toString();
        $reflectionClass = new \ReflectionClass($externalExceptionClass);
        if (
            $reflectionClass->isFinal()
            // || $reflectionClass->isInterface()
        ) {
            return;
        }

        file_put_contents(
            __DIR__."/../Exceptions/{$node->getLast()}.php",
            <<<PHP
                <?php

                declare(strict_types=1);

                /**
                 * This file is part of the guanguans/notify.
                 *
                 * (c) guanguans <ityaozm@gmail.com>
                 *
                 * This source file is subject to the MIT license that is bundled.
                 */

                namespace Guanguans\\Notify\\Foundation\\Exceptions;

                use Guanguans\\Notify\\Foundation\\Contracts\\Throwable;

                class {$node->getLast()} extends \\$externalExceptionClass implements Throwable {}

                PHP
        );
    }
}
