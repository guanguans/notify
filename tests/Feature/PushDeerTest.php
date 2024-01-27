<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\NotifyTests\Feature;

use Guanguans\Notify\Factory;
use Guanguans\Notify\Messages\PushDeerMessage;
use Guanguans\NotifyTests\TestCase;
use GuzzleHttp\Exception\ServerException;

/**
 * @internal
 *
 * @small
 */
class PushDeerTest extends TestCase
{
    public function testPushDeer(): void
    {
        $this->expectException(ServerException::class);

        $ret = Factory::pushDeer()
            ->setToken('PDU8024TTt9Yvx4wkm08SmSXAY9pnPycl5RrB')
            ->setMessage(new PushDeerMessage('## This is text.', '> This is desp.', 'markdown'))
            ->send();

        $this->assertEmpty($ret['content']['result']);
    }
}
