<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\WeWork;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextMessage extends Message
{
    /**
     * @var string
     */
    protected $type = 'text';

    /**
     * @var string[]
     */
    protected $defined = [
        'content',
        'mentioned_list',
        'mentioned_mobile_list',
    ];

    /**
     * @var array<string, array<string>>
     */
    protected $allowedTypes = [
        'mentioned_list' => ['int', 'string', 'array'],
        'mentioned_mobile_list' => ['int', 'string', 'array'],
    ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $resolver): void {
            $resolver->setNormalizer('mentioned_list', static function (OptionsResolver $optionsResolver, $value): array {
                return (array) $value;
            });
            $resolver->setNormalizer('mentioned_mobile_list', static function (OptionsResolver $optionsResolver, $value): array {
                return (array) $value;
            });
        });
    }

    /**
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->setOption('content', $content);

        return $this;
    }

    /**
     * @return $this
     */
    public function setMentionedList(array $mentionedList): self
    {
        $this->setOption('mentioned_list', $mentionedList);

        return $this;
    }

    /**
     * @return $this
     */
    public function setMentionedMobileList(array $mentionedMobileList): self
    {
        $this->setOption('mentioned_mobile_list', $mentionedMobileList);

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
