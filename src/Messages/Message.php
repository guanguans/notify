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
use Symfony\Component\OptionsResolver\OptionsResolver;

class Message implements MessageInterface
{
    use HasOptions;

    /**
     * @var string[]
     */
    protected $defined = [];

    /**
     * @var string[]
     */
    protected $required = [];

    /**
     * @var array
     */
    protected $allowedTypes = [];

    /**
     * @var array
     */
    protected $allowedValues = [];

    /**
     * Message constructor.
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * {@inheritDoc}
     */
    protected function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        return tap($resolver, function (OptionsResolver $resolver) {
            $resolver->setDefined($this->defined);
            $resolver->setRequired($this->required);

            foreach ($this->allowedTypes as $option => $allowedType) {
                $resolver->setAllowedTypes($option, $allowedType);
            }

            foreach ($this->allowedValues as $option => $allowedValue) {
                $resolver->setAllowedValues($option, $allowedValue);
            }
        });
    }

    /**
     * {@inheritDoc}
     */
    public function transformToRequestParams()
    {
        return $this->getOptions();
    }
}
