<?php

namespace Guanguans\Notify\Clients;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PushDeerClient extends Client
{
    public const REQUEST_URL_TEMPLATE = '%s/message/push?pushkey=%s';

    protected $defined = [
        'token',
        'message',
        'base_uri',
    ];

    protected $options = [
        'base_uri' => 'https://api2.pushdeer.com',
    ];

    protected function configureOptionsResolver(OptionsResolver $resolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($resolver), function (OptionsResolver $resolver) {
            $resolver->setNormalizer('base_uri', function (Options $options, $value) {
                return trim($value, '/');
            });
        });
    }

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
            $this->getToken()
        );
    }
}
