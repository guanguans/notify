<?php

declare(strict_types=1);

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
    /**
     * @var string
     */
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
     * @var string[]
     */
    protected $allowedTypes = [
        'btns' => 'array',
    ];

    /**
     * @var array
     */
    protected $options = [
        'btnOrientation' => 0,
        'hideAvatar' => 0,
        'btns' => [],
    ];

    public function __construct(array $options)
    {
        $btns = $options['btns'] ?? [];
        unset($options['btns']);
        parent::__construct($options);

        $this->addBtns($btns);
    }

    public function setBtns(array $btns): self
    {
        return $this->addBtns($btns);
    }

    public function addBtns(array $btns): self
    {
        foreach ($btns as $btn) {
            $this->addBtn($btn);
        }

        return $this;
    }

    public function setBtn(array $btn): self
    {
        return $this->addBtn($btn);
    }

    public function addBtn(array $btn): self
    {
        $this->options['btns'][] = configure_options($btn, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver->setDefined([
                'title',
                'actionURL',
            ]);
        });

        return $this;
    }

    /**
     * @return array<int|string, mixed>
     */
    public function transformToRequestParams(): array
    {
        return [
            'msgtype' => $this->type,
            $this->type => $this->getOptions(),
        ];
    }
}
