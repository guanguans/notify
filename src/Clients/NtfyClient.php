<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

/**
 * @see https://ntfy.sh
 * @see https://docs.ntfy.sh/publish/
 */
class NtfyClient extends Client
{
    protected $requestMethod = 'postJson';

    /**
     * @var string[]
     */
    protected $defined = [
        'message',
        'base_uri',
    ];

    /**
     * @var string[]
     */
    protected $options = [
        'base_uri' => 'https://ntfy.sh',
    ];

    /**
     * @return $this
     */
    public function setBaseUri(string $baseUri): self
    {
        $this->setOption('base_uri', $baseUri);

        return $this;
    }

    public function getBaseUri(): string
    {
        return $this->getOption('base_uri');
    }

    public function getRequestUrl(): string
    {
        return $this->getBaseUri();
    }
}
