<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpFieldAssignmentTypeMismatchInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpVoidFunctionResultUsedInspection */
/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpMissingParentCallCommonInspection */
declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\NotifyTests;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\Attributes\Small;
use Symfony\Component\VarDumper\Test\VarDumperTestTrait;

#[Small]
class TestCase extends \PHPUnit\Framework\TestCase
{
    use MockeryPHPUnitIntegration;
    use PHPMock;
    use VarDumperTestTrait;

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass(): void {}

    /**
     * This method is called after the last test of this test class is run.
     */
    public static function tearDownAfterClass(): void {}

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        // \DG\BypassFinals::enable(bypassReadOnly: false);
    }

    /**
     * Performs assertions shared by all tests of a test case.
     *
     * This method is called between setUp() and test.
     */
    protected function assertPreConditions(): void {}

    // /**
    //  * Performs assertions shared by all tests of a test case.
    //  *
    //  * This method is called between test and tearDown().
    //  *
    //  * @see \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditions::assertPostConditions()
    //  * @see \Mockery\Adapter\Phpunit\MockeryTestCase
    //  */
    // protected function assertPostConditions(): void {}

    /**
     * This method is called after each test.
     */
    protected function tearDown(): void {}
}
