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

class LinkMessage extends Message
{
    protected $type = 'link';

    protected $initOptions = [
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
                'link',
                'sound',
                'priority',
            ]);

            $resolver->setAllowedTypes('link', 'string');
            $resolver->setAllowedTypes('sound', 'int');
            $resolver->setAllowedTypes('priority', 'int');

            $resolver->setAllowedTypes('sound', [0, 1]);
        });

        $this->options = array_merge($this->options, $diffOptions);

        return $this;
    }
}
