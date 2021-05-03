<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ServerChanClient extends AbstractClient
{
    public const ENDPOINT_URL_TEMPLATE = 'https://sctapi.ftqq.com/%s.send';

    protected $contentIsMarkdown = true;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $keyword;

    public function setOptions(array $options): AbstractClient
    {
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'token',
                'keyword',
                'title',
                'content',
                'content_is_markdown',
                'markdown_template',
            ]);
            $resolver->setAllowedTypes('keyword', 'string');
            $resolver->setAllowedTypes('token', 'string');
            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('content', 'string');
            $resolver->setAllowedTypes('content_is_markdown', 'bool');
            $resolver->setAllowedTypes('markdown_template', 'string');
        });

        $this->options = array_merge($this->options, $diffOptions);
        $this->setOptionsToProperties($this->options);

        return $this;
    }

    public function send()
    {
        return $this->getHttpClient()->post($this->getEndpointUrl(), $this->getParams());
    }

    public function getEndpointUrl(): string
    {
        return sprintf(static::ENDPOINT_URL_TEMPLATE, $this->token);
    }

    public function getData(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->getContent(),
        ];
    }

    public function getParams()
    {
        return $this->getData();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        $this->keyword && $this->content = sprintf("关键字: %s\n%s", $this->keyword, $this->content);

        if (true === $this->contentIsMarkdown) {
            return sprintf($this->markdownTemplate, $this->content);
        }

        return $this->content;
    }

    /**
     * @return $this
     */
    public function setTitle(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getKeyword(): string
    {
        return $this->keyword;
    }

    /**
     * @return $this
     */
    public function setKeyword(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }
}
