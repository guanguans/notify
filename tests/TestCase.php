<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\NotifyTests;

use phpmock\phpunit\PHPMock;

/**
 * @coversNothing
 *
 * @small
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    use Faker;
    use PHPMock;

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
