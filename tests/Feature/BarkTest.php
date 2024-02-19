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
use Guanguans\Notify\Messages\BarkMessage;
use Guanguans\NotifyTests\TestCase;
use GuzzleHttp\Exception\ClientException;

/**
 * @internal
 *
 * @small
 */
class BarkTest extends TestCase
{
    public function testBark(): void
    {
        $this->expectException(ClientException::class);

        $barkMessage = new BarkMessage([
            'title' => 'This is title.',
            'body' => 'This is body.',
            'copy' => 'This is copy.',
            'url' => 'https://github.com/guanguans/notify',
            'sound' => 'bell',
            'group' => 'group',
            // 'icon' => 'https://avatars0.githubusercontent.com/u/25671453?s=200&v=4',
            // 'group' => 'group',
            // 'level' => 'passive',
            // 'badge' => 5,
            // 'isArchive' => 1,
            // 'autoCopy' => 1,
            // 'automaticallyCopy' => 1,
        ]);
        Factory::bark()
            // ->setBaseUri('The server address of your own deployment.')
            ->setToken('ihnPXb8KDj9dHStfQ5c')
            ->setMessage($barkMessage)
            ->send();
    }
}
