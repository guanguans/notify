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

class XiZhiClient extends AbstractClient
{
    public const ENDPOINT_URL_TEMPLATE = [
        'single_point' => 'https://xizhi.qqoq.net/%s.send',
        'channel' => 'https://xizhi.qqoq.net/%s.channel',
    ];

    protected $contentIsMarkdown = true;

    protected $pushType = 'single_point';

    /**
     * @var string
     */
    protected $title;

    public function setOptions(array $options): AbstractClient
    {
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'token',
                'push_type',
                'title',
                'content',
                'content_is_markdown',
                'markdown_template',
            ]);
            $resolver->setAllowedTypes('push_type', 'string');
            $resolver->setAllowedTypes('token', 'string');
            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('content', 'string');
            $resolver->setAllowedTypes('content_is_markdown', 'bool');
            $resolver->setAllowedTypes('markdown_template', 'string');

            $resolver->setAllowedValues('push_type', ['single_point', 'channel']);
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
        if ('channel' === $this->pushType) {
            return sprintf(static::ENDPOINT_URL_TEMPLATE['channel'], $this->token);
        }

        return sprintf(static::ENDPOINT_URL_TEMPLATE['single_point'], $this->token);
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

    /**
     * @return $this
     */
    public function setTitle(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getPushType(): string
    {
        return $this->pushType;
    }

    /**
     * @return $this
     */
    public function setPushType(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }
}
