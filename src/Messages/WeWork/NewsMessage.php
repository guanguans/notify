<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\WeWork;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsMessage extends Message
{
    protected $type = 'news';

    public function configureOptionsResolver()
    {
        parent::configureOptionsResolver();

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefined([
                'articles',
            ]);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefault('articles', []);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedTypes('articles', 'array');
        });

        return $this;
    }

    public function setArticles(array $articles)
    {
        return $this->addArticles($articles);
    }

    public function addArticles(array $articles)
    {
        foreach ($articles as $article) {
            $this->addArticle($article);
        }

        return $this;
    }

    public function setArticle(array $article)
    {
        return $this->addArticle($article);
    }

    public function addArticle(array $article)
    {
        $this->options['articles'][] = configure_options(array_diff($article, $this->options['articles']), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'title',
                'description',
                'url',
                'picurl',
            ]);

            $resolver->setRequired(['title', 'url']);

            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('description', 'string');
            $resolver->setAllowedTypes('url', 'string');
            $resolver->setAllowedTypes('picurl', 'string');
        });

        return $this;
    }

    public function transformToRequestParams()
    {
        return [
            'msgtype' => 'news',
            'news' => [
                'articles' => $this->options['articles'],
            ],
        ];
    }
}
