<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Clients;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @see https://ntfy.sh
 * @see https://docs.ntfy.sh/publish/
 */
class NtfyClient extends Client
{
    protected $requestMethod = 'postJson';

    /**
     * @var string[]
     */
    protected $defined = [
        'message',
        'base_uri',
    ];

    /**
     * @var string[]
     */
    protected $options = [
        'base_uri' => 'https://ntfy.sh/',
    ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $optionsResolver): void {
            // $optionsResolver->setNormalizer('base_uri', static function (OptionsResolver $optionsResolver, $value): string {
            //     return trim($value, '/');
            // });
        });
    }

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
        return $this->getBaseUri();
    }
}
