<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpVoidFunctionResultUsedInspection */
/** @noinspection StaticClosureCanBeUsedInspection */
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
use Symfony\Component\VarDumper\Test\VarDumperTestTrait;

class TestCase extends \PHPUnit\Framework\TestCase
{
    use Faker;
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
        // \DG\BypassFinals::enable();
    }

    /**
     * This method is called after each test.
     */
    protected function tearDown(): void
    {
        $this->finish();
        $this->closeMockery();
    }

    /**
     * Run extra tear down code.
     */
    protected function finish(): void
    {
        // call more tear down methods
    }
}
