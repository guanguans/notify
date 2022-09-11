<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Tests;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Tear down the test case.
     */
    protected function tearDown(): void
    {
        $this->finish();
        parent::tearDown();
    }

    /**
     * Run extra tear down code.
     */
    protected function finish(): void
    {
        // call more tear down methods
    }
}
