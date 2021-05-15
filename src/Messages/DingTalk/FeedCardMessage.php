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
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeedCardMessage extends Message
{
    protected $type = 'feedCard';

    /**
     * @var string[]
     */
    protected $defined = [
        'links',
        'secret',
    ];

    public function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        $resolver = parent::configureOptionsResolver($resolver);

        return tap($resolver, function ($resolver) {
            $resolver->setAllowedTypes('links', 'array');
        });
    }

    public function transformToRequestParams()
    {
        $data = [
            'msgtype' => $this->type,
            $this->type => $this->options,
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
