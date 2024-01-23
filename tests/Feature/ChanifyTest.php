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
use Guanguans\Notify\Messages\Chanify\LinkMessage;
use Guanguans\Notify\Messages\Chanify\TextMessage;
use Guanguans\NotifyTests\TestCase;
use GuzzleHttp\Exception\ClientException;

class ChanifyTest extends TestCase
{
    public function testText(): void
    {
        $this->expectException(ClientException::class);

        Factory::chanify()
            ->setToken('CIDfh4gGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFGhR7vAyf8Uj5UQhhK4n6QfVzih96QyIECAEQAQ.E0eBnLbfNwWrWZ1YSAZfkCQWZAPdBl6pVr26lRf6')
            ->setMessage(new TextMessage([
                'title' => 'This is title.',
                'text' => 'This is text.',
                // 'copy'     => 'This is copy.',
                // 'actions'  => [
                //     "ActionName1|http://<action host>/<action1>",
                //     "ActionName2|http://<action host>/<action2>",
                // ],
                // 'autocopy' => 0,
                // 'sound'    => 0,
                // 'priority' => 10,
            ]))
            ->send();
    }

    public function testLink(): void
    {
        $this->expectException(ClientException::class);

        Factory::chanify()
            ->setToken('CIDfh4gGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFGhR7vAyf8Uj5UQhhK4n6QfVzih96QyIECAEQAQ.E0eBnLbfNwWrWZ1YSAZfkCQWZAPdBl6pVr26lRf6')
            ->setMessage(new LinkMessage([
                'link' => 'https://github.com/guanguans/notify',
                // 'sound'    => 0,
                // 'priority' => 10,
            ]))
            ->send();
    }
}
