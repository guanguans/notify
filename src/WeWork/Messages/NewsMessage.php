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

namespace Guanguans\Notify\WeWork\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self articles(array $articles)
 */
class NewsMessage extends Message
{
    /** @var list<string> */
    protected array $defined = [
        'articles',
    ];

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'articles' => 'array',
    ];

    /** @var array<string, mixed> */
    protected array $options = [
        'articles' => [],
    ];

    /**
     * @api
     */
    public function addArticle(array $article): self
    {
        $this->options['articles'][] = $article;

        return $this;
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setDefault('articles', static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setPrototype(true)
                ->setDefined([
                    'title',
                    'description',
                    'url',
                    'picurl',
                ]);
        });
    }

    protected function type(): string
    {
        return 'news';
    }
}
