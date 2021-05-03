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

class BarkClient extends AbstractClient
{
    public const ENDPOINT_URL_TEMPLATE = '%s/%s/%s';

    /**
     * @var string
     */
    protected $baseUri = 'https://api.day.app';

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $sound = 'bell';

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $copy;

    /**
     * @var int
     */
    protected $isAutomaticallyCopy = 1;

    /**
     * @var int
     */
    protected $isArchive = 1;

    public function setOptions(array $options): AbstractClient
    {
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'token',
                'title',
                'content',
                'sound',
                'is_archive',
                'url',
                'copy',
                'is_automatically_copy',
            ]);
            $resolver->setAllowedTypes('token', 'string');
            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('content', 'string');
            $resolver->setAllowedTypes('sound', 'string');
            $resolver->setAllowedTypes('is_archive', 'int');
            $resolver->setAllowedTypes('url', 'string');
            $resolver->setAllowedTypes('copy', 'string');
            $resolver->setAllowedTypes('is_automatically_copy', 'int');

            $resolver->setAllowedValues('is_archive', [0, 1]);
            $resolver->setAllowedValues('is_automatically_copy', [0, 1]);
            $resolver->setAllowedValues('url', function ($value) {
                return false !== filter_var($value, FILTER_VALIDATE_URL);
            });
        });

        $this->options = array_merge($this->options, $diffOptions);
        $this->setOptionsToProperties($this->options);

        return $this;
    }

    /**
     * @return array|string[]
     */
    public function getData(): array
    {
        return [
            'title' => $this->getTitle(),
            'sound' => $this->getSound(),
            'isArchive' => $this->getIsArchive(),
            'url' => $this->getUrl(),
            'copy' => $this->getCopy(),
            'automaticallyCopy' => $this->getIsAutomaticallyCopy(),
        ];
    }

    /**
     * @return array|string[]
     */
    public function getParams(): array
    {
        return $this->getData();
    }

    /**
     * @return $this
     */
    public function setBaseUri(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), trim($value, '/'));

        return $this;
    }

    public function getTitle(): ?string
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

    public function getSound(): string
    {
        return $this->sound;
    }

    /**
     * @return $this
     */
    public function setSound(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getIsArchive(): int
    {
        return $this->isArchive;
    }

    /**
     * @return $this
     */
    public function setIsArchive(int $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return $this
     */
    public function setUrl(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getCopy(): string
    {
        return $this->copy;
    }

    /**
     * @param $copy
     *
     * @return $this
     */
    public function setCopy(string $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    public function getIsAutomaticallyCopy(): int
    {
        return $this->isAutomaticallyCopy;
    }

    /**
     * @return $this
     */
    public function setIsAutomaticallyCopy(int $value): self
    {
        $this->setOption($this->getPropertyNameBySetMethod(__FUNCTION__), $value);

        return $this;
    }

    /**
     * @return array|\GuzzleHttp\Promise\PromiseInterface|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string
     */
    public function send()
    {
        $httpQueryParams = http_build_query($this->getParams());

        return $this->getHttpClient()->get($this->getEndpointUrl().'?'.$httpQueryParams);
    }

    public function getEndpointUrl(): string
    {
        return sprintf(static::ENDPOINT_URL_TEMPLATE, $this->baseUri, $this->token, $this->getContent());
    }
}
