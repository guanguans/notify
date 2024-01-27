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
use Guanguans\Notify\Messages\ShowdocPushMessage;
use Guanguans\NotifyTests\TestCase;

/**
 * @internal
 *
 * @small
 */
class ShowdocPushTest extends TestCase
{
    public function testShowdocPush(): void
    {
        $this->expectOutputRegex('/^url或token不正确|token$/');

        $ret = Factory::showdocPush()
            ->setToken('f096edb95f92540219a41e47060eeb6d9461')
            ->setMessage(new ShowdocPushMessage('This is title.', 'This is content.'))
            ->send();

        echo $ret['error_message'];
    }
}
