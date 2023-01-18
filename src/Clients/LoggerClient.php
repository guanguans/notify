<?php

declare(strict_types=1);

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

    /**
     * @var array<string, string>
     */
    protected $options = [
        'level' => 'info',
    ];

    /**
     * @var string[]|array[]
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
        $this->setOption('logger', $logger);

        return $this;
    }

    public function getLevel(): string
    {
        return $this->getOption('level');
    }

    public function setLevel(string $level): self
    {
        $this->setOption('level', $level);

        return $this;
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
