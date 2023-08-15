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

class FeedCardMessage extends Message
{
    /**
     * @var string
     */
    protected $type = 'feedCard';

    /**
     * @var string[]
     */
    protected $defined = [
        'links',
    ];

    /**
     * @var array<string, string>
     */
    protected $allowedTypes = [
        'links' => 'array',
    ];

    /**
     * @var array[]
     */
    protected $options = [
        'links' => [],
    ];

    public function __construct(array $links = [])
    {
        parent::__construct([
            'links' => $links,
        ]);
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $resolver): void {
            $resolver->setNormalizer('links', static function (OptionsResolver $optionsResolver, array $value): array {
                return isset($value[0]) ? $value : [$value];
            });
        });
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
