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

class FeiShuClient extends AbstractClient
{
    public const REQUEST_URL_TEMPLATE = 'https://open.feishu.cn/open-apis/bot/v2/hook/%s';

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

        return $this->getMessage()->getData();
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

        return $this->getHttpClient()->postJson($this->getRequestUrl(), $this->getParams());
    }

    public function getRequestUrl(): string
    {
        return sprintf(static::REQUEST_URL_TEMPLATE, $this->getToken());
    }
}
