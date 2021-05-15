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
    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'text',
        'copy',
        'actions',
        'autocopy',
        'sound',
        'priority',
    ];

    /**
     * @var string[]
     */
    protected $options = [
        'autocopy' => 0,
        'sound' => 0,
        'priority' => 10,
    ];

    /**
     * {@inheritDoc}
     */
    protected function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        $resolver = parent::configureOptionsResolver($resolver);

        return tap($resolver, function (OptionsResolver $resolver) {
            $resolver->setAllowedTypes('actions', 'array');
        });
    }
}
