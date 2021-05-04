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

class ServerChanClient extends AbstractClient
{
    public const REQUEST_URL_TEMPLATE = 'https://sctapi.ftqq.com/%s.send';

    public const CHECK_REQUEST_URL_TEMPLATE = 'https://sctapi.ftqq.com/push?id=%s&readkey=%s';

    /**
     * @var array[]
     */
    protected $initOptions = [];

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
            ]);
            $resolver->setAllowedTypes('token', 'string');
            $resolver->setAllowedTypes('message', 'object');
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

        $data = $this->getMessage()->getData();

        isset($data['keyword']) && $data['keyword'] && $data['desp'] = sprintf("关键字: %s\n %s", $data['keyword'], $data['desp']);

        return $data;
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

    public function check(string $pushId, string $readKey)
    {
        return $this->getHttpClient()->get(sprintf(static::CHECK_REQUEST_URL_TEMPLATE, $pushId, $readKey));
    }

    public function getRequestUrl(): string
    {
        return sprintf(static::REQUEST_URL_TEMPLATE, $this->getToken());
    }
}
