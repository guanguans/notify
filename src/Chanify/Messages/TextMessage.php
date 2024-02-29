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
 * @method self autocopy($autocopy)
 * @method self sound($sound)
 * @method self priority($priority)
 * @method self interruptionlevel($interruptionlevel)
 * @method self actions(array $actions)
 * @method self timeline(array $timeline)
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

    protected array $allowedTypes = [
        'actions' => 'array',
        'timeline' => 'array',
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
