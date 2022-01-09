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

class BarkTest extends TestCase
{
    public function testBark()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        $barkMessage = new \Guanguans\Notify\Messages\BarkMessage([
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
