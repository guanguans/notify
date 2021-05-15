<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\DingTalk;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionCardMessage extends Message
{
    protected $type = 'actionCard';

    /**
     * @var string[]
     */
    protected $defined = [
        'pushType',
        'title',
        'text',
        'btnOrientation',
        'singleTitle',
        'singleURL',
        'secret',
        'hideAvatar',
        'btns',
    ];

    /**
     * @var string[]
     */
    protected $options = [
        'pushType' => 'single',
    ];

    public function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        $resolver = parent::configureOptionsResolver($resolver);

        return tap($resolver, function ($resolver) {
            $resolver->setAllowedTypes('btns', 'array');
            $resolver->setAllowedValues('pushType', ['single', 'btns']);
        });
    }

    public function transformToRequestParams()
    {
        if ('single' === $this->options['pushType']) {
            unset($this->options['btns']);
        }
        if ('btns' === $this->options['pushType']) {
            unset($this->options['singleTitle']);
            unset($this->options['singleURL']);
        }
        $data = [
            'msgtype' => $this->type,
            $this->type => $this->options,
        ];

        return $data;
    }
}
