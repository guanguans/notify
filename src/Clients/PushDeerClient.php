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

class PushDeerClient extends Client
{
    /**
     * @var string
     */
    public const REQUEST_URL_TEMPLATE = '%s/message/push?pushkey=%s';

    /**
     * @var string[]
     */
    protected $defined = [
        'token',
        'message',
        'base_uri',
    ];

    /**
     * @var array<string, string>
     */
    protected $options = [
        'base_uri' => 'https://api2.pushdeer.com',
    ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $optionsResolver): void {
            $optionsResolver->setNormalizer('base_uri', static function (Options $options, $value): string {
                return trim($value, '/');
            });
        });
    }

    public function setBaseUri(string $baseUri): self
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
