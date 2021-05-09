<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

class XiZhiClient extends Client
{
    public const REQUEST_URL_TEMPLATE = [
        'single_point' => 'https://xizhi.qqoq.net/%s.send',
        'channel' => 'https://xizhi.qqoq.net/%s.channel',
    ];

    protected function configureOptionsResolver()
    {
        parent::configureOptionsResolver();

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefined([
                'push_type',
            ]);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefault('push_type', 'single_point');
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedTypes('push_type', 'string');
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedValues('push_type', ['single_point', 'channel']);
        });

        return $this;
    }

    public function getRequestUrl(): string
    {
        'single_point' === $this->getOptions('push_type') && $url = sprintf(static::REQUEST_URL_TEMPLATE['single_point'], $this->getToken());
        'channel' === $this->getOptions('push_type') && $url = sprintf(static::REQUEST_URL_TEMPLATE['channel'], $this->getToken());

        return $url;
    }
}
