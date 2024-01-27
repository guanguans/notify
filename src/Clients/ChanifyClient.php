<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ChanifyClient extends Client
{
    public const REQUEST_URL_TEMPLATE = '%s/%s';

    /**
     * @var array<string>
     */
    protected array $defined = [
        'token',
        'message',
        'base_uri',
    ];

    /**
     * @var array<string>
     */
    protected array $options = [
        'base_uri' => 'https://api.chanify.net/v1/sender',
    ];

    /**
     * @return $this
     */
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

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $optionsResolver): void {
            $optionsResolver->setNormalizer('base_uri', static fn (OptionsResolver $optionsResolver, $value): string => trim($value, '/'));
        });
    }
}
