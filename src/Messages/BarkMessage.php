<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

class BarkMessage extends Message
{
    protected $type = 'text';

    public function configureOptionsResolver()
    {
        parent::configureOptionsResolver();

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefined([
                'title',
                'text',
                'sound',
                'isArchive',
                'url',
                'copy',
                'automaticallyCopy',
            ]);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefault('sound', 'bell');
            $resolver->setDefault('isArchive', 1);
            $resolver->setDefault('automaticallyCopy', 1);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('text', 'string');
            $resolver->setAllowedTypes('sound', 'string');
            $resolver->setAllowedTypes('isArchive', 'int');
            $resolver->setAllowedTypes('url', 'string');
            $resolver->setAllowedTypes('copy', 'string');
            $resolver->setAllowedTypes('automaticallyCopy', 'int');
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedValues('isArchive', [0, 1]);
            $resolver->setAllowedValues('automaticallyCopy', [0, 1]);
        });

        return $this;
    }
}
