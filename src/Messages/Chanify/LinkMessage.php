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

class LinkMessage extends Message
{
    protected $type = 'link';

    public function configureOptionsResolver()
    {
        parent::configureOptionsResolver();

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefined([
                'link',
                'sound',
                'priority',
            ]);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefault('sound', 1);
            $resolver->setDefault('priority', 10);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedTypes('link', 'string');
            $resolver->setAllowedTypes('sound', 'int');
            $resolver->setAllowedTypes('priority', 'int');
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedValues('sound', [0, 1]);
        });

        return $this;
    }
}
