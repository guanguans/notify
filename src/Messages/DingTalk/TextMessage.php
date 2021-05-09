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

class TextMessage extends Message
{
    protected $type = 'text';

    public function configureOptionsResolver()
    {
        parent::configureOptionsResolver();

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefined([
                'content',
                'atMobiles',
                'atUserIds',
                'isAtAll',
                'secret',
            ]);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedTypes('secret', 'string');
            $resolver->setAllowedTypes('content', 'string');
            $resolver->setAllowedTypes('atMobiles', ['string', 'array']);
            $resolver->setAllowedTypes('atUserIds', ['string', 'array']);
            $resolver->setAllowedTypes('isAtAll', 'bool');
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setNormalizer('atMobiles', function (Options $options, $value) {
                return (array) $value;
            });
            $resolver->setNormalizer('atUserIds', function (Options $options, $value) {
                return (array) $value;
            });
        });

        return $this;
    }

    public function transformToRequestParams()
    {
        $data = [
            'msgtype' => $this->type,
            'text' => $this->options,
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
