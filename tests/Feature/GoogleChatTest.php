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
use Guanguans\NotifyTests\TestCase;
use GuzzleHttp\Exception\ClientException;

/**
 * @internal
 *
 * @small
 */
class GoogleChatTest extends TestCase
{
    public function testGoogleChat(): void
    {
        $this->markTestSkipped(self::class.' is skipped.');

        $this->expectException(ClientException::class);

        Factory::googleChat()
            ->setToken('accessToken')
            ->setKey('accessKey')
            ->setSpace('space')
            // ->setThreadKey('threadKey')
            ->setMessage(
                new \Guanguans\Notify\Messages\GoogleChatMessage([
                    'text' => 'This is a testing.',
                ])
            )
            ->send();
    }
}
