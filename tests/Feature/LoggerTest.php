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
use Guanguans\Notify\Messages\LoggerMessage;
use Guanguans\Notify\Tests\TestCase;
use Psr\Log\NullLogger;

class LoggerTest extends TestCase
{
    public function testLogger(): void
    {
        // $this->markTestSkipped(__CLASS__.' is skipped.');

        $ret = Factory::logger()
            ->setLogger(new NullLogger())
            // ->setLevel('warning')
            ->setMessage(new LoggerMessage('This is a testing.'))
            ->send();

        $this->assertNull($ret);
    }
}
