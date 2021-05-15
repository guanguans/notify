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

class TextMessage extends Message
{
    protected $type = 'text';

    /**
     * @var string[]
     */
    protected $defined = [
        'content',
        'atMobiles',
        'atUserIds',
        'isAtAll',
        'secret',
    ];

    public function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        $resolver = parent::configureOptionsResolver($resolver);

        return tap($resolver, function ($resolver) {
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
    }

    public function transformToRequestParams()
    {
        $data = [
            'msgtype' => $this->type,
            'text' => $this->options,
            'at' => $this->options,
        ];

        if ($this->options['secret']) {
            $data['timestamp'] = $time = time().sprintf('%03d', random_int(1, 999));
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
