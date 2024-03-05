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

    protected array $options = [
        'post' => [],
    ];

    public function setPostForLang(string $lang, array $post): self
    {
        $this->options['post'][$lang] = $post;

        return $this;
    }

    protected function type(): string
    {
        return 'post';
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefault('post', static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setPrototype(true)
                ->setDefined([
                    'title',
                    'content',
                ])
                ->setAllowedTypes('content', 'array');
        });
    }
}
