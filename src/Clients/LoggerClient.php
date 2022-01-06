<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

use Guanguans\Notify\Contracts\MessageInterface;
use Psr\Log\LoggerInterface;

class LoggerClient extends Client
{
    /**
     * @var string[]
     */
    protected $defined = [
        'message',
        'logger',
        'level',
    ];

    protected $options = [
        'level' => 'info',
    ];

    /**
     * @var string[]
     */
    protected $allowedValues = [
        'level' => [
            'debug',
            'info',
            'notice',
            'warning',
            'error',
            'critical',
            'alert',
            'emergency',
        ],
    ];

    public function getRequestMethod(): string
    {
        return $this->getLevel();
    }

    public function getRequestUrl(): string
    {
        return $this->getLevel();
    }

    public function getLogger(): LoggerInterface
    {
        return $this->getOption('logger');
    }

    public function setLogger(LoggerInterface $logger): self
    {
        return $this->setOption('logger', $logger);
    }

    public function getLevel(): string
    {
        return $this->getOption('level');
    }

    public function setLevel(string $level): self
    {
        return $this->setOption('level', $level);
    }

    public function send(MessageInterface $message = null)
    {
        $message and $this->setMessage($message);

        return $this->wrapSendCallbacks(function () {
            return $this->response = $this->getLogger()
                ->{$this->getLevel()}(
                    $this->getRequestParams()['message'],
                    $this->getRequestParams()['context']
                );
        });
    }
}
