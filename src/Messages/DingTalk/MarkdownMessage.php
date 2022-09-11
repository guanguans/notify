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
    /**
     * @var string
     */
    protected $type = 'markdown';

    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'text',
        'atMobiles',
        'atDingtalkIds',
        'isAtAll',
    ];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'atMobiles' => ['int', 'string', 'array'],
        'atDingtalkIds' => ['int', 'string', 'array'],
        'isAtAll' => 'bool',
    ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function ($resolver): void {
            $resolver->setNormalizer('atMobiles', static function (Options $options, $value): array {
                return (array) $value;
            });
            $resolver->setNormalizer('atDingtalkIds', static function (Options $options, $value): array {
                return (array) $value;
            });
        });
    }

    /**
     * @return array<int|string, mixed>
     */
    public function transformToRequestParams(): array
    {
        return [
            'msgtype' => $this->type,
            $this->type => $this->getOptions(),
            'at' => $this->getOptions(),
        ];
    }
}
