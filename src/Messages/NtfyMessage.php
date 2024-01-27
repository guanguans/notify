<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

class NtfyMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'topic',
        'message',
        'title',
        'priority',
        'tags',
        'delay',
        'actions',
        'click',
        'attach',
        'icon',
        'filename',
        'email',
        'cache',
        'firebase',
    ];

    protected $required = [
        'topic',
    ];

    /**
     * @var array<string>
     */
    protected array $allowedTypes = [
        'tags' => 'array',
        'actions' => 'array',
    ];

    protected array $allowedValues = [
        'priority' => [5, 4, 3, 2, 1],
        'cache' => ['yes', 'no'],
        'firebase' => ['yes', 'no'],
    ];

    /**
     * @var array<array>
     */
    protected array $options = [
        'tags' => [],
        'actions' => [],
    ];

    public function setActions(array $actions): self
    {
        return $this->addActions($actions);
    }

    public function addActions(array $actions): self
    {
        foreach ($actions as $action) {
            $this->addAction($action);
        }

        return $this;
    }

    public function setAction(array $action): self
    {
        return $this->addAction($action);
    }

    public function addAction(array $action): self
    {
        $this->options['actions'][] = configure_options($action, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setDefined([
                    'action',
                    'label',
                    'clear',

                    'intent',
                    'extras',

                    'url',
                    'method',
                    'headers',
                    'body',
                ])
                ->setAllowedTypes('clear', 'bool')
                ->setAllowedTypes('extras', 'array')
                ->setAllowedTypes('headers', 'array')
                ->setAllowedValues('action', ['broadcast', 'http', 'view']);
        });

        return $this;
    }
}
