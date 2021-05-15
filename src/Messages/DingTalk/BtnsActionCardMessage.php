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

class BtnsActionCardMessage extends Message
{
    protected $type = 'actionCard';

    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'text',
        'hideAvatar',
        'btnOrientation',
        'btns',
    ];

    /**
     * @var array
     */
    protected $options = [
        'btnOrientation' => 0,
        'hideAvatar' => 0,
        'btns' => [],
    ];

    public function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        $resolver = parent::configureOptionsResolver($resolver);

        return tap($resolver, function ($resolver) {
            $resolver->setAllowedTypes('btns', 'array');
        });
    }

    public function setBtns(array $Btns)
    {
        return $this->addBtns($Btns);
    }

    public function addBtns(array $Btns)
    {
        foreach ($Btns as $Btn) {
            $this->addBtn($Btn);
        }

        return $this;
    }

    public function setBtn(array $Btn)
    {
        return $this->addBtn($Btn);
    }

    public function addBtn(array $Btn)
    {
        $this->options['btns'][] = configure_options($Btn, function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'title',
                'actionURL',
            ]);
        });

        return $this;
    }

    public function transformToRequestParams()
    {
        return [
            'msgtype' => $this->type,
            $this->type => $this->options,
        ];
    }
}
