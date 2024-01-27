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
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\FeedCardMessage links(array $links)
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

    public function __construct(array $links = [])
    {
        parent::__construct(['links' => $links]);
    }

    public function setLinks(array $Links): self
    {
        return $this->addLinks($Links);
    }

    public function addLinks(array $Links): self
    {
        foreach ($Links as $Link) {
            $this->addLink($Link);
        }

        return $this;
    }

    public function setLink(array $Link): self
    {
        return $this->addLink($Link);
    }

    public function addLink(array $Link): self
    {
        $this->options['links'][] = configure_options($Link, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver->setDefined([
                'title',
                'messageURL',
                'picURL',
            ]);
        });

        return $this;
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(
            parent::configureOptionsResolver($optionsResolver),
            static function (OptionsResolver $resolver): void {
                $resolver->setNormalizer(
                    'links',
                    static fn (OptionsResolver $optionsResolver, array $value): array => isset($value[0]) ? $value : [$value]
                );
            }
        );
    }

    protected function type(): string
    {
        return 'feedCard';
    }
}
