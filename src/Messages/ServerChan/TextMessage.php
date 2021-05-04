<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\ServerChan;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextMessage extends Message
{
    protected $type = 'text';

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

    /**
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'title',
                'desp',
                'keyword',
            ]);

            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('desp', 'string');
            $resolver->setAllowedTypes('keyword', 'string');
        });

        $this->options = array_merge($this->options, $diffOptions);

        return $this;
    }
}
