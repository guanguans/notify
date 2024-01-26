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
 * @method \Guanguans\Notify\Chanify\Messages\TextMessage title($title)
 * @method \Guanguans\Notify\Chanify\Messages\TextMessage text($text)
 * @method \Guanguans\Notify\Chanify\Messages\TextMessage copy($copy)
 * @method \Guanguans\Notify\Chanify\Messages\TextMessage actions($actions)
 * @method \Guanguans\Notify\Chanify\Messages\TextMessage autocopy($autocopy)
 * @method \Guanguans\Notify\Chanify\Messages\TextMessage sound($sound)
 * @method \Guanguans\Notify\Chanify\Messages\TextMessage priority($priority)
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

    protected array $options = [
        'autocopy' => 0,
        'sound' => 0,
        'priority' => 10,
    ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(
            parent::configureOptionsResolver($optionsResolver),
            static function (OptionsResolver $optionsResolver): void {
                $optionsResolver->setNormalizer(
                    'actions',
                    static function (OptionsResolver $optionsResolver, $value): array {
                        return (array) $value;
                    }
                );
            }
        );
    }
}
