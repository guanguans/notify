<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\DingTalk\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self title($title)
 * @method self text($text)
 * @method self btnOrientation($btnOrientation)
 * @method self btns(array $btns)
 */
class BtnsActionCardMessage extends Message
{
    protected array $defined = [
        'title',
        'text',
        'btnOrientation',
        'btns',
    ];

    protected array $allowedTypes = [
        'btns' => 'array',
    ];

    protected array $options = [
        'btns' => [],
    ];

    public function addBtn(array $btn): self
    {
        $this->options['btns'][] = $btn;

        return $this;
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefault('btns', static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setPrototype(true)
                ->setDefined([
                    'title',
                    'actionURL',
                ]);
        });
    }

    protected function type(): string
    {
        return 'actionCard';
    }
}
