<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

class WebhookMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'headers',
        'query',
        'body',
        'verify',
    ];

    protected $options = [
        'verify' => false,
    ];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'verify' => 'bool',
    ];

    public function __construct(array $body = [])
    {
        parent::__construct([
            'body' => $body,
        ]);
    }

    public function setHeaders(array $headers)
    {
        $this->setOption('headers', $headers);

        return $this;
    }

    public function setQuery(array $query)
    {
        $this->setOption('query', $query);

        return $this;
    }

    public function setBody(array $body)
    {
        $this->setOption('body', $body);

        return $this;
    }

    public function setVerify(bool $verify)
    {
        $this->setOption('verify', $verify);

        return $this;
    }

    public function transformToRequestParams()
    {
        return $this->getOption('body');
    }
}
