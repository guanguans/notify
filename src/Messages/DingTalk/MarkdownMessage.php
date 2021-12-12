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

class MarkdownMessage extends Message
{
    protected $type = 'markdown';

    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'text',
        'atMobiles',
        'atUserIds',
        'isAtAll',
    ];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'atMobiles' => ['int', 'string', 'array'],
        'atUserIds' => ['int', 'string', 'array'],
        'isAtAll' => 'bool',
    ];

    public function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($resolver), function ($resolver) {
            $resolver->setNormalizer('atMobiles', function (Options $options, $value) {
                return (array) $value;
            });
            $resolver->setNormalizer('atUserIds', function (Options $options, $value) {
                return (array) $value;
            });
        });
    }

    public function transformToRequestParams()
    {
        return [
            'msgtype' => $this->type,
            $this->type => $this->getOptions(),
            'at' => $this->getOptions(),
        ];
    }
}
