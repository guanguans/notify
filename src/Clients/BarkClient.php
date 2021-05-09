<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

class BarkClient extends Client
{
    public const REQUEST_URL_TEMPLATE = '%s/%s/%s?%s';

    protected function configureOptionsResolver()
    {
        parent::configureOptionsResolver();

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefined([
                'base_uri',
            ]);
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setDefault('base_uri', 'https://api.day.app');
        });

        tap(static::$resolver, function ($resolver) {
            $resolver->setAllowedTypes('base_uri', 'string');
        });

        return $this;
    }

    public function getRequestUrl(): string
    {
        return sprintf(
            static::REQUEST_URL_TEMPLATE,
            $this->getOptions('base_uri'),
            $this->getToken(),
            $this->getMessage()->getOptions('text'),
            http_build_query($this->getRequestParams())
        );
    }
}
