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
        return tap($resolver, function ($resolver) {
            $resolver->setDefined($this->defined);
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
