<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

use Guanguans\Notify\Contracts\MessageInterface;
use Guanguans\Notify\Traits\HasOptions;

class Message implements MessageInterface
{
    use HasOptions;

    protected $type;

    protected $initOptions = [];

    /**
     * TextMessage constructor.
     *
     * @param string $text
     */
    public function __construct(array $options = [])
    {
        $this->initOptions($this->initOptions);
        $this->setOptions($options);
    }

    public function getData()
    {
        return $this->options;
    }

    public function getType()
    {
        return $this->type;
    }

    public function __toString()
    {
        return get_class($this);
    }
}
