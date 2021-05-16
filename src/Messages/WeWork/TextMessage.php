<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\WeWork;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextMessage extends Message
{
    protected $type = 'text';

    /**
     * @var string[]
     */
    protected $defined = [
        'content',
        'mentioned_list',
        'mentioned_mobile_list',
    ];

    public function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        $resolver = parent::configureOptionsResolver($resolver);

        return tap($resolver, function ($resolver) {
            $resolver->setAllowedTypes('mentioned_list', ['int', 'string', 'array']);
            $resolver->setAllowedTypes('mentioned_mobile_list', ['int', 'string', 'array']);
            $resolver->setNormalizer('mentioned_list', function (Options $options, $value) {
                return (array) $value;
            });
            $resolver->setNormalizer('mentioned_mobile_list', function (Options $options, $value) {
                return (array) $value;
            });
        });
    }

    /**
     * @return $this
     */
    public function setContent(string $content)
    {
        $this->setOption('content', $content);

        return $this;
    }

    /**
     * @return $this
     */
    public function setMentionedList(array $mentionedList)
    {
        $this->setOption('mentioned_list', $mentionedList);

        return $this;
    }

    /**
     * @return $this
     */
    public function setMentionedMobileList(array $mentionedMobileList)
    {
        $this->setOption('mentioned_mobile_list', $mentionedMobileList);

        return $this;
    }

    public function transformToRequestParams()
    {
        return [
            'msgtype' => $this->type,
            $this->type => $this->getOptions(),
        ];
    }
}
