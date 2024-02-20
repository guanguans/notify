<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Chanify\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self title($title)
 * @method self text($text)
 * @method self copy($copy)
 * @method self actions($actions)
 * @method self autocopy($autocopy)
 * @method self sound($sound)
 * @method self priority($priority)
 */
class TextMessage extends Message
{
    protected array $defined = [
        'title',
        'text',
        'copy',
        'actions',
        'autocopy',
        'sound',
        'priority',
    ];

    protected array $allowedTypes = [
        'actions' => ['string', 'array'],
    ];

    // protected array $options = [
    //     'autocopy' => 0,
    //     'sound' => 0,
    //     'priority' => 10,
    // ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setNormalizer(
            'actions',
            static fn (OptionsResolver $optionsResolver, $value): array => (array) $value
        );
    }
}
