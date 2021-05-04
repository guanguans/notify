<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\Chanify;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextMessage extends Message
{
    protected $type = 'text';

    protected $initOptions = [
        [
            'name' => 'autocopy',
            'allowed_types' => ['int'],
            'default' => 1,
        ],
        [
            'name' => 'sound',
            'allowed_types' => ['int'],
            'default' => 1,
        ],
        [
            'name' => 'priority',
            'allowed_types' => ['int'],
            'default' => 10,
        ],
    ];

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
                'text',
                'copy',
                'autocopy',
                'sound',
                'priority',
            ]);

            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('text', 'string');
            $resolver->setAllowedTypes('copy', 'string');
            $resolver->setAllowedTypes('autocopy', 'int');
            $resolver->setAllowedTypes('sound', 'int');
            $resolver->setAllowedTypes('priority', 'int');

            $resolver->setAllowedTypes('autocopy', [0, 1]);
            $resolver->setAllowedTypes('sound', [0, 1]);
        });

        $this->options = array_merge($this->options, $diffOptions);

        return $this;
    }
}
