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

class TextMessage extends Message
{
    protected string $type = 'text';

    /**
     * @var array<string>
     */
    protected array $defined = [
        'content',
        'atMobiles',
        'atDingtalkIds',
        'isAtAll',
    ];

    protected array $allowedTypes = [
        'atMobiles' => ['int', 'string', 'array'],
        'atDingtalkIds' => ['int', 'string', 'array'],
        'isAtAll' => 'bool',
    ];

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

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $resolver): void {
            $resolver->setNormalizer('atMobiles', static fn (OptionsResolver $optionsResolver, $value): array => (array) $value);
            $resolver->setNormalizer('atDingtalkIds', static fn (OptionsResolver $optionsResolver, $value): array => (array) $value);
        });
    }
}
