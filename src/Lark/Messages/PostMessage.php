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

namespace Guanguans\Notify\Lark\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self post(array $post)
 */
class PostMessage extends AbstractMessage
{
    /** @var list<string> */
    protected array $defined = [
        'post',
    ];

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'post' => 'array',
    ];

    /** @var array<string, mixed> */
    protected array $options = [
        'post' => [],
    ];

    /**
     * @api
     *
     * @param string $lang eg: zh_cn, en_us
     * @param array{title: string, content: array<array-key, mixed>} $post
     */
    public function postFor(string $lang, array $post): self
    {
        $this->options['post'][$lang] = $post;

        return $this;
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

    protected function type(): string
    {
        return 'post';
    }
}
