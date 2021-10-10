<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\DingTalk;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeedCardMessage extends Message
{
    protected $type = 'feedCard';

    /**
     * @var string[]
     */
    protected $defined = [
        'links',
    ];

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

    public function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($resolver), function ($resolver) {
            $resolver->setNormalizer('links', function (Options $options, $value) {
                return isset($value[0]) ? $value : [$value];
            });
        });
    }

    public function setLinks(array $Links)
    {
        return $this->addLinks($Links);
    }

    public function addLinks(array $Links)
    {
        foreach ($Links as $Link) {
            $this->addLink($Link);
        }

        return $this;
    }

    public function setLink(array $Link)
    {
        return $this->addLink($Link);
    }

    public function addLink(array $Link)
    {
        $this->options['links'][] = configure_options($Link, function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'title',
                'messageURL',
                'picURL',
            ]);
        });

        return $this;
    }

    public function transformToRequestParams()
    {
        return [
            'msgtype' => $this->type,
            $this->type => $this->getOption(),
        ];
    }
}
