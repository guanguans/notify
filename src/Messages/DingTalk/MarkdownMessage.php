<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\DingTalk;

use Guanguans\Notify\Messages\Message;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarkdownMessage extends Message
{
    protected $type = 'markdown';

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
        $diffOptions = configure_options(array_diff($options, $this->options), function (OptionsResolver $resolver) {
            $resolver->setDefined([
                'title',
                'text',
                'atMobiles',
                'atUserIds',
                'isAtAll',
                'secret',
            ]);

            $resolver->setAllowedTypes('secret', 'string');
            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('text', 'string');
            $resolver->setAllowedTypes('atMobiles', ['string', 'array']);
            $resolver->setAllowedTypes('atUserIds', ['string', 'array']);
            $resolver->setAllowedTypes('isAtAll', 'bool');

            $resolver->setNormalizer('atMobiles', function (Options $options, $value) {
                return (array) $value;
            });
            $resolver->setNormalizer('atUserIds', function (Options $options, $value) {
                return (array) $value;
            });
        });

        $this->options = array_merge($this->options, $diffOptions);

        return $this;
    }

    public function getData()
    {
        $data = [
            'msgtype' => $this->type,
            $this->type => $this->options,
            'at' => $this->options,
        ];

        if ($this->options['secret']) {
            $data['timestamp'] = $time = time().sprintf('%03d', rand(1, 999));
            $data['sign'] = $this->getSign($this->options['secret'], $time);
        }

        return $data;
    }

    /**
     * @return string
     */
    protected function getSign(string $secret, int $timestamp)
    {
        $data = sprintf("%s\n%s", $timestamp, $secret);

        $hash = hash_hmac('sha256', $data, $secret, true);

        return urlencode(base64_encode($hash));
    }
}
