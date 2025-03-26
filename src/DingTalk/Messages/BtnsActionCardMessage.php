<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\DingTalk\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self btnOrientation(mixed $btnOrientation)
 * @method self btns(array $btns)
 * @method self text(mixed $text)
 * @method self title(mixed $title)
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
