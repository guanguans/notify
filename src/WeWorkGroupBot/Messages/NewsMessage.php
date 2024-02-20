<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\WeWorkGroupBot\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method self articles(array $articles)
 */
class NewsMessage extends Message
{
    protected array $defined = [
        'articles',
    ];

    protected array $allowedTypes = [
        'articles' => 'array',
    ];

    protected array $options = [
        'articles' => [],
    ];

    public function addArticle(array $article): self
    {
        $this->options['articles'][] = $this->configureAndResolveOptions(
            $article,
            static function (OptionsResolver $optionsResolver): void {
                $optionsResolver->setDefined([
                    'title',
                    'description',
                    'url',
                    'picurl',
                ]);
            }
        );

        return $this;
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setNormalizer('articles', static fn (
            OptionsResolver $optionsResolver,
            array $value
        ): array => isset($value[0]) ? $value : [$value]);
    }

    protected function type(): string
    {
        return 'news';
    }
}
