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
    private array $except = [];

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
            Node\Expr\New_::class,
        ];
    }

    /**
     * @param Node\Expr\New_ $node
     *
     * @throws \ReflectionException
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function refactor(Node $node)
    {
        $class = $node->class;

        if (
            ! $class instanceof Name
            || Str::is($this->except, $class->toString())
            || 0 === strncmp(
                $class->toString(),
                'Guanguans\\Notify\\Foundation\\Exceptions\\',
                \strlen('Guanguans\\Notify\\Foundation\\Exceptions\\')
            )
            || 0 !== substr_compare($class->toString(), 'Exception', -\strlen('Exception'))
        ) {
            return;
        }

        $internalExceptionClass = "\\Guanguans\\Notify\\Foundation\\Exceptions\\{$class->getLast()}";
        if (! class_exists($internalExceptionClass)) {
            $this->createInternalException($class);
        }

        $node->class = new Name($internalExceptionClass, $class->getAttributes());

        return $node;
    }

    /**
     * @throws \ReflectionException
     */
    private function createInternalException(Name $name): void
    {
        $externalExceptionClass = $name->toString();
        $reflectionClass = new \ReflectionClass($externalExceptionClass);
        if ($reflectionClass->isFinal()) {
            return;
        }

        file_put_contents(
            __DIR__."/../Exceptions/{$name->getLast()}.php",
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

                class {$name->getLast()} extends \\$externalExceptionClass implements Throwable {}

                PHP
        );
    }
}
