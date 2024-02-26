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

    public function addLink(array $Link): self
    {
        $this->options['links'][] = $this->configureAndResolveOptions($Link, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver->setDefined([
                'title',
                'messageURL',
                'picURL',
            ]);
        });

        return $this;
    }

    protected function type(): string
    {
        return 'feedCard';
    }
}
