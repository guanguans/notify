<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\DingTalkGroupBot\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\BtnsActionCardMessage title($title)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\BtnsActionCardMessage text($text)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\BtnsActionCardMessage hideAvatar($hideAvatar)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\BtnsActionCardMessage btnOrientation($btnOrientation)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\BtnsActionCardMessage btns(array $btns)
 */
class BtnsActionCardMessage extends Message
{
    protected array $defined = [
        'title',
        'text',
        'hideAvatar',
        'btnOrientation',
        'btns',
    ];

    protected array $allowedTypes = [
        'btns' => 'array',
    ];

    protected array $options = [
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

    protected function type(): string
    {
        return 'actionCard';
    }
}
