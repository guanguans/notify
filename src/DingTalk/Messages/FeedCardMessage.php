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
 * @method self links(array $links)
 */
class FeedCardMessage extends Message
{
    protected array $defined = [
        'links',
    ];

    protected array $allowedTypes = [
        'links' => 'array',
    ];

    protected array $options = [
        'links' => [],
    ];

    public function addLink(array $link): self
    {
        $this->options['links'][] = $link;

        return $this;
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefault('links', static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setPrototype(true)
                ->setDefined([
                    'title',
                    'messageURL',
                    'picURL',
                ]);
        });
    }

    protected function type(): string
    {
        return 'feedCard';
    }
}
