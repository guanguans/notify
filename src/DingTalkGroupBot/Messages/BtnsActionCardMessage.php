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
 * @method self title($title)
 * @method self text($text)
 * @method self hideAvatar($hideAvatar)
 * @method self btnOrientation($btnOrientation)
 * @method self btns(array $btns)
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

    public function addBtn(array $btn): self
    {
        $this->options['btns'][] = $this->configureAndResolveOptions($btn, static function (OptionsResolver $optionsResolver): void {
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
