<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Logger;

use Guanguans\Notify\Foundation\Contracts\Message;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class Client implements \Guanguans\Notify\Foundation\Contracts\Client, LoggerAwareInterface
{
    use LoggerAwareTrait;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger ?: new NullLogger();
    }

    public function send(Message $message)
    {
        $this->logger->log($message['level'], $message['message'], $message['context']);
    }
}
