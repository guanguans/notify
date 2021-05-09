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

class LinkMessage extends Message
{
    protected $type = 'link';

    public function configureOptionsResolver()
    {
        parent::configureOptionsResolver();

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefined([
                'title',
                'text',
                'picUrl',
                'messageUrl',
                'secret',
            ]);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('text', 'string');
            $resolver->setAllowedTypes('picUrl', 'string');
            $resolver->setAllowedTypes('messageUrl', 'string');
            $resolver->setAllowedTypes('secret', 'string');
        });

        return $this;
    }

    public function transformToRequestParams()
    {
        $data = [
            'msgtype' => $this->type,
            $this->type => $this->options,
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
