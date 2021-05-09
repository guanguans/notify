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

class TextMessage extends Message
{
    protected $type = 'text';

    public function configureOptionsResolver()
    {
        parent::configureOptionsResolver();

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefined([
                'content',
                'mentioned_list',
                'mentioned_mobile_list',
            ]);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedTypes('content', 'string');
            $resolver->setAllowedTypes('mentioned_list', ['string', 'array']);
            $resolver->setAllowedTypes('mentioned_mobile_list', ['string', 'array']);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setNormalizer('mentioned_list', function (Options $options, $value) {
                return (array) $value;
            });
            $resolver->setNormalizer('mentioned_mobile_list', function (Options $options, $value) {
                return (array) $value;
            });
        });

        return $this;
    }

    public function transformToRequestParams()
    {
        return [
            'msgtype' => 'text',
            'text' => $this->options,
        ];
    }
}
