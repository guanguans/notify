<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Chanify\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self actions(array $actions)
 * @method self autocopy(mixed $autocopy)
 * @method self copy(mixed $copy)
 * @method self interruptionlevel(mixed $interruptionlevel)
 * @method self priority(mixed $priority)
 * @method self sound(mixed $sound)
 * @method self text(mixed $text)
 * @method self timeline(array $timeline)
 * @method self title(mixed $title)
 */
class TextMessage extends Message
{
    protected array $defined = [
        'title',
        'text',
        'copy',
        'autocopy',
        'sound',
        'priority',
        'interruptionlevel',
        'actions',
        'timeline',
    ];
    protected array $allowedValues = [
        // 'interruptionlevel' => ['active', 'passive', 'time-sensitive'],
    ];
    protected array $allowedTypes = [
        'actions' => 'array',
        'timeline' => 'array',
    ];
    protected array $options = [
        'actions' => [],
    ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefault('timeline', static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setDefined([
                    'code',
                    'timestamp',
                    'items',
                ])
                ->setAllowedTypes('items', 'array');
        });
    }
}
