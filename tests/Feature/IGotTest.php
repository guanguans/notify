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
use Guanguans\Notify\Messages\IGotMessage;
use Guanguans\NotifyTests\TestCase;

/**
 * @internal
 *
 * @small
 */
class IGotTest extends TestCase
{
    public function testIGot(): void
    {
        // $this->markTestSkipped(__CLASS__.' is skipped.');

        $ret = Factory::iGot()
            ->setToken('5dcd2f91d38cc47447414')
            ->setMessage(
                new IGotMessage([
                    'content' => 'This is content.',
                    // 'title' => 'This is title.',
                    // 'url' => 'https://www.github.com/guanguans/notify',
                    // 'automaticallyCopy' => 1,
                    // 'urgent' => 1,
                    // 'copy' => 'This is copy.',
                    // 'detail' => [
                    //     'title' => 'This is detail title.',
                    //     'content' => 'This is detail content.',
                    // ],
                ])
            )
            ->send();

        $this->assertSame(201, $ret['ret']);
    }
}
