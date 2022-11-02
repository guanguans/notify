<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PushoverMessage extends Message
{
    /**
     * @var string[]
     */
    protected $defined = [
        // 'token',
        // 'user',
        'message',
        'title',
        'timestamp',
        'priority',
        'url',
        'url_title',
        'sound',
        'retry',
        'expire',
        'html',
        'monospace',
        'callback',
        'device',
        'attachment',
    ];

    /**
     * @var string[]
     */
    protected $required = [
        // 'token',
        // 'user',
        'message',
    ];

    /**
     * @var array
     */
    protected $allowedTypes = [
        'timestamp' => 'int',
        'priority' => 'int',
        'retry' => 'int',
        'expire' => 'int',
        'html' => 'int',
        'monospace' => 'int',
        'attachment' => ['string',  'resource'],
    ];

    /**
     * @var \int[][]
     */
    protected $allowedValues = [
        'priority' => [-2, -1, 0, 1, 2],
        'html' => [0, 1],
        'monospace' => [0, 1],
    ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $resolver): void {
            $resolver->setNormalizer('priority', static function (OptionsResolver $resolver, $value) {
                if (2 === $value && ! isset($resolver['retry'], $resolver['expire'])) {
                    throw new MissingOptionsException('The required option "retry" or "expire" is missing.');
                }

                return $value;
            });

            $resolver->setNormalizer('html', static function (OptionsResolver $resolver, $value) {
                if (1 === $value && isset($resolver['monospace']) && 1 === $resolver['monospace']) {
                    throw new InvalidOptionsException('Html cannot be set with monospace, Monospace cannot be set with html, Html and monospace are mutually.');
                }

                return $value;
            });

            $resolver->setNormalizer('attachment', static function (OptionsResolver $resolver, $value) {
                if (is_string($value)) {
                    if (empty($value)) {
                        throw new InvalidOptionsException('The attachment cannot be empty.');
                    }

                    $value = fopen($value, 'rb');
                    if (false === $value) {
                        throw new InvalidOptionsException("The attachment resource file does not exist: $value.");
                    }
                }

                return [
                    'attachment' => $value,
                ];
            });
        });
    }
}
