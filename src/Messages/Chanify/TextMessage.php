<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\Chanify;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TextMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        'title',
        'text',
        'copy',
        'actions',
        'autocopy',
        'sound',
        'priority',
    ];

    /**
     * @var \string[][]
     */
    protected $allowedTypes = [
        'actions' => ['string', 'array'],
    ];

    /**
     * @var mixed[]
     */
    protected $options = [
        'autocopy' => 0,
        'sound' => 0,
        'priority' => 10,
    ];

    /**
     * {@inheritDoc}
     */
    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $optionsResolver): void {
            $optionsResolver->setNormalizer('actions', static function (Options $options, $value): array {
                return (array) $value;
            });
        });
    }
}
