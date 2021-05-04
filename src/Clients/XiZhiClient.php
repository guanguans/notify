<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

use Guanguans\Notify\Exceptions\Exception;
use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\OptionsResolver;

class XiZhiClient extends AbstractClient
{
    public const REQUEST_URL_TEMPLATE = [
        'single_point' => 'https://xizhi.qqoq.net/%s.send',
        'channel' => 'https://xizhi.qqoq.net/%s.channel',
    ];

    /**
     * @var array[]
     */
    protected $initOptions = [
        [
            'name' => 'push_type',
            'allowed_types' => ['string'],
            'default' => 'single_point',
            'allowed_values' => ['single_point', 'channel'],
        ],
    ];

    public function __construct(array $options = [])
    {
        parent::__construct($options);
    }

    /**
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'token',
                'message',
                'push_type',
            ]);

            $resolver->setAllowedTypes('token', 'string');
            $resolver->setAllowedTypes('message', 'object');
            $resolver->setAllowedTypes('push_type', 'string');

            $resolver->setAllowedValues('push_type', ['single_point', 'channel']);
        });

        $this->options = array_merge($this->options, $diffOptions);

        return $this;
    }

    /**
     * @return array|string[]
     */
    public function getParams(): array
    {
        if (empty($this->getMessage())) {
            throw new Exception('No Message!');
        }

        if (! $this->getMessage() instanceof Message) {
            throw new Exception(sprintf('The message no instanceof %s', Message::class));
        }

        return $this->getMessage()->getData();
    }

    /**
     * @return $this
     */
    public function setBaseUri(string $baseUri): self
    {
        $this->setOption('base_uri', trim($baseUri, '/'));

        return $this;
    }

    public function getBaseUri(): string
    {
        return $this->getOptions('base_uri');
    }

    /**
     * @param null $message
     *
     * @return array|\GuzzleHttp\Promise\PromiseInterface|object|\Overtrue\Http\Support\Collection|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Guanguans\Notify\Exceptions\Exception
     */
    public function send($message = null)
    {
        $message && $this->message = $message;

        return $this->getHttpClient()->post($this->getRequestUrl(), $this->getParams());
    }

    public function getRequestUrl(): string
    {
        'single_point' === $this->getOptions('push_type') && $url = sprintf(static::REQUEST_URL_TEMPLATE['single_point'], $this->getToken());
        'channel' === $this->getOptions('push_type') && $url = sprintf(static::REQUEST_URL_TEMPLATE['channel'], $this->getToken());

        return $url;
    }
}
