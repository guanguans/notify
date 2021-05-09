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

class ActionCardMessage extends Message
{
    protected $type = 'actionCard';

    public function configureOptionsResolver()
    {
        parent::configureOptionsResolver();

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefined([
                'pushType',
                'title',
                'text',
                'btnOrientation',
                'singleTitle',
                'singleURL',
                'secret',
                'hideAvatar',
                'btns',
            ]);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefault('pushType', 'single');
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedTypes('title', 'string');
            $resolver->setAllowedTypes('text', 'string');
            $resolver->setAllowedTypes('btnOrientation', 'string');
            $resolver->setAllowedTypes('singleTitle', 'string');
            $resolver->setAllowedTypes('singleURL', 'string');
            $resolver->setAllowedTypes('hideAvatar', 'string');
            $resolver->setAllowedTypes('btns', 'array');
            $resolver->setAllowedTypes('secret', 'string');
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedValues('pushType', ['single', 'btns']);
        });

        return $this;
    }

    public function transformToRequestParams()
    {
        if ('single' === $this->options['pushType']) {
            unset($this->options['btns']);
        }
        if ('btns' === $this->options['pushType']) {
            unset($this->options['singleTitle']);
            unset($this->options['singleURL']);
        }
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
