<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChanifyClient extends Client
{
    public const REQUEST_URL_TEMPLATE = '%s/%s';

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
        'base_uri',
    ];

    /**
     * @var string[]
     */
    protected $options = [
        'base_uri' => 'https://api.chanify.net/v1/sender',
    ];

    protected function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($resolver), function (OptionsResolver $resolver) {
            $resolver->setNormalizer('base_uri', function (Options $options, $value) {
                return trim($value, '/');
            });
        });
    }

    /**
     * @return $this
     */
    public function setBaseUri(string $baseUri)
    {
        $this->setOption('base_uri', $baseUri);

        return $this;
    }

    public function getBaseUri(): string
    {
        return $this->getOption('base_uri');
    }

    public function getRequestUrl(): string
    {
        return sprintf(
            static::REQUEST_URL_TEMPLATE,
            $this->getBaseUri(),
            $this->getToken());
    }
}
