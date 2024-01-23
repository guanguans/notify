<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\NotifyTests;

use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use phpmock\phpunit\PHPMock;

/**
 * @internal
 *
 * @coversNothing
 *
 * @small
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    use ArraySubsetAsserts;
    use PHPMock;

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
    }

    /**
     * This method is called after the last test of this test class is run.
     */
    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
    }

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        // \DG\BypassFinals::enable();
    }

    /**
     * This method is called after each test.
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        $this->finish();
        \Mockery::close();
    }

    /**
     * Run extra tear down code.
     */
    protected function finish(): void
    {
        // call more tear down methods
    }
}
