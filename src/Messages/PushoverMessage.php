<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

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
     * @var string[]
     */
    protected $allowedTypes = [
        'timestamp' => 'int',
        'priority' => 'int',
        'retry' => 'int',
        'expire' => 'int',
        'html' => 'int',
        'monospace' => 'int',
    ];

    /**
     * @var \int[][]
     */
    protected $allowedValues = [
        'priority' => [-2, -1, 0, 1, 2],
        'html' => [0, 1],
        'monospace' => [0, 1],
    ];

    /**
     * @var array
     */
    protected $options = [
    ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $resolver): void {
            $resolver->setNormalizer('priority', static function (OptionsResolver $resolver, $value) {
                if (2 === $value && ! isset($resolver['retry'], $resolver['expire'])) {
                    new MissingOptionsException('The required option "retry" or "expire" is missing.');
                }

                return $value;
            });
        });
    }
}
