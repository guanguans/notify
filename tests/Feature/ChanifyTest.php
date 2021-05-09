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

class ChanifyTest extends TestCase
{
    public function testText()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        $ret = Factory::chanify()
            ->setToken('CIDfh4gGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFGhR7vAyf8Uj5UQhhK4n6QfVzih96QyIECAEQAQ.')
            ->setMessage((new \Guanguans\Notify\Messages\Chanify\TextMessage([
                'text' => __CLASS__,
            ])))
            ->send();
    }

    public function testLink()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        $ret = Factory::chanify()
            ->setToken('CIDfh4gGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFGhR7vAyf8Uj5UQhhK4n6QfVzih96QyIECAEQAQ.')
            ->setMessage((new \Guanguans\Notify\Messages\Chanify\LinkMessage([
                'link' => 'https://www.baidu.com',
            ])))
            ->send();
    }
}
