<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\WeWork\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self content($content)
 * @method self mentionedList($mentionedList)
 * @method self mentionedMobileList($mentionedMobileList)
 */
class TextMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'content',
        'mentioned_list',
        'mentioned_mobile_list',
    ];

    /**
     * @var array<string, array<string>>
     */
    protected array $allowedTypes = [
        'mentioned_list' => ['int', 'string', 'array'],
        'mentioned_mobile_list' => ['int', 'string', 'array'],
    ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setNormalizer(
            'mentioned_list',
            static fn (OptionsResolver $optionsResolver, $value): array => (array) $value
        );
        $optionsResolver->setNormalizer(
            'mentioned_mobile_list',
            static fn (OptionsResolver $optionsResolver, $value): array => (array) $value
        );
    }

    protected function type(): string
    {
        return 'text';
    }
}
