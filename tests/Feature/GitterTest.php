<?php

declare(strict_types=1);

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
use GuzzleHttp\Exception\ClientException;

class GitterTest extends TestCase
{
    public function testGitter(): void
    {
        $this->expectException(ClientException::class);

        Factory::gitter()
            ->setToken('b9e7931ecacb08b7ab4df5e98bc149d33d7faf1')
            ->setRoomId('61af21b96da03739848bfef')
            ->setMessage(new \Guanguans\Notify\Messages\GitterMessage('This is testing.'))
            ->send();
    }
}
