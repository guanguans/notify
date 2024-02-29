<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Lark\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self post(array $post)
 */
class PostMessage extends Message
{
    protected array $defined = [
        'post',
    ];

    protected array $allowedTypes = [
        'post' => 'array',
    ];

    protected function type(): string
    {
        return 'post';
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefault('post', static function (OptionsResolver $optionsResolver): void {
            foreach (['zh_cn', 'en_us'] as $lang) {
                $optionsResolver
                    ->define($lang)
                    ->allowedTypes('array')
                    ->default(static function (OptionsResolver $optionsResolver): void {
                        $optionsResolver
                            ->setDefined(['title', 'content'])
                            ->setAllowedTypes('content', 'array');
                    });
            }
        });
    }
}
