<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\WeWork;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\Options;
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
        parent::__construct($options);
    }

    /**
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'content',
                'mentioned_list',
                'mentioned_mobile_list',
            ]);

            $resolver->setAllowedTypes('content', 'string');
            $resolver->setAllowedTypes('mentioned_list', ['string', 'array']);
            $resolver->setAllowedTypes('mentioned_mobile_list', ['string', 'array']);

            $resolver->setNormalizer('mentioned_list', function (Options $options, $value) {
                return (array) $value;
            });
            $resolver->setNormalizer('mentioned_mobile_list', function (Options $options, $value) {
                return (array) $value;
            });
        });

        $this->options = array_merge($this->options, $diffOptions);

        return $this;
    }
}
