<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

class XiZhiMessage extends Message
{
    protected $type = 'text';

    public function configureOptionsResolver()
    {
        parent::configureOptionsResolver();

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefined([
                'title',
                'content',
            ]);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('content', 'string');
        });

        return $this;
    }
}
