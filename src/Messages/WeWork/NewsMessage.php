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

    protected $initOptions = [];

    /**
     * TextMessage constructor.
     *
     * @param string $text
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }

    /**
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $diffOptions = array_diff($options, $this->options);
        $diffOptions = configure_options($diffOptions, function (OptionsResolver $resolver) use ($diffOptions) {
            $resolver->setDefined([
                'articles',
            ]);

            $resolver->setAllowedTypes('articles', 'array');

            foreach ($diffOptions['articles'] as $article) {
                configure_options($article, function (OptionsResolver $resolver) {
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
            }
        });

        $this->options = array_merge($this->options, $diffOptions);

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
}
