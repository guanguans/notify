<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\DingTalk\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self links(array $links)
 */
class FeedCardMessage extends Message
{
    /** @var list<string> */
    protected array $defined = [
        'links',
    ];

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'links' => 'array',
    ];

    /** @var array<string, mixed> */
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
