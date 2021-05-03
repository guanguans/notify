<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

use Guanguans\Notify\Contracts\GatewayInterface;
use Guanguans\Notify\Contracts\MessageInterface;
use Guanguans\Notify\Contracts\RequestInterface;
use Guanguans\Notify\Support\Str;
use Guanguans\Notify\Traits\HasHttpClient;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractClient implements GatewayInterface, MessageInterface, RequestInterface
{
    use HasHttpClient;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var string
     */
    protected $format = 'urlencoded';

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var bool
     */
    protected $contentIsMarkdown = false;

    /**
     * @var string
     */
    protected $markdownTemplate = <<<"markdownTemplate"
``` shell
%s
```
markdownTemplate;

    /**
     * AbstractClient constructor.
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    public function getName(): string
    {
        return str_replace([__NAMESPACE__.'\\', 'Client'], '', get_class($this));
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'token',
                'content',
                'contentIsMarkdown',
                'markdownTemplate',
            ]);
            $resolver->setAllowedTypes('token', 'string');
            $resolver->setAllowedTypes('content', 'string');
            $resolver->setAllowedTypes('contentIsMarkdown', 'bool');
            $resolver->setAllowedTypes('markdownTemplate', 'string');
        });

        $this->options = array_merge($this->options, $diffOptions);
        $this->setOptionsToProperties($this->options);

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setOption(string $key, $value): self
    {
        $this->setOptions([$key => $value]);

        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return $this
     */
    public function setToken(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getContent(): string
    {
        if (true === $this->contentIsMarkdown) {
            return sprintf($this->markdownTemplate, $this->content);
        }

        return $this->content;
    }

    /**
     * @return $this
     */
    public function setContent(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getContentIsMarkdown(): bool
    {
        return $this->contentIsMarkdown;
    }

    /**
     * @return $this
     */
    public function setContentIsMarkdown(bool $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getMarkdownTemplate(): string
    {
        return $this->markdownTemplate;
    }

    /**
     * @param string $markdownTemplate
     *
     * @return $this
     */
    public function setMarkdownTemplate(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);
    }

    protected function getPropertyNameBySetMethod(string $setMethodName): string
    {
        return Str::snake(ltrim($setMethodName, 'set'));
    }

    protected function setOptionsToProperties(array $options): void
    {
        foreach ($options as $key => $value) {
            $property = Str::camel($key);
            property_exists($this, $key) && $this->{$property} = $value;
        }
    }

    abstract public function send();
}
