<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\Bark;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextMessage extends Message
{
    protected $type = 'text';

    /**
     * @var array[]
     */
    protected $initOptions = [
        [
            'name' => 'sound',
            'allowed_types' => ['string'],
            'default' => 'bell',
        ],
        [
            'name' => 'isArchive',
            'allowed_types' => ['int'],
            'default' => 1,
        ],
        [
            'name' => 'automaticallyCopy',
            'allowed_types' => ['int'],
            'default' => 1,
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
                'sound',
                'isArchive',
                'url',
                'copy',
                'automaticallyCopy',
            ]);

            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('text', 'string');
            $resolver->setAllowedTypes('sound', 'string');
            $resolver->setAllowedTypes('isArchive', 'int');
            $resolver->setAllowedTypes('url', 'string');
            $resolver->setAllowedTypes('copy', 'string');
            $resolver->setAllowedTypes('automaticallyCopy', 'int');

            $resolver->setAllowedValues('isArchive', [0, 1]);
            $resolver->setAllowedValues('automaticallyCopy', [0, 1]);
        });

        $this->options = array_merge($this->options, $diffOptions);

        return $this;
    }
}
