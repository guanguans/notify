<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Tests\Feature;

use Guanguans\Notify\Factory;
use Guanguans\Notify\Tests\TestCase;

class LoggerTest extends TestCase
{
    public function testLogger()
    {
        $this->markTestSkipped(__METHOD__.' is skipped.');

        $ret = Factory::logger()
            ->setLogger(new \Psr\Log\NullLogger())
            // ->setLevel('warning')
            ->setMessage(new \Guanguans\Notify\Messages\LoggerMessage('This is a testing.'))
            ->send();

        $this->assertNull($ret);
    }
}
