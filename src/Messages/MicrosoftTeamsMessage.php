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

class MicrosoftTeamsMessage extends Message
{
    /**
     * @var array<string>
     */
    protected array $defined = [
        'correlationId',
        'expectedActors',
        'originator',
        'summary',
        'themeColor',
        'hideOriginalBody',
        'title',
        'text',
        'sections',
        'potentialAction',
    ];

    protected $required = [
    ];

    /**
     * @var array<string>
     */
    protected array $allowedTypes = [
        'hideOriginalBody' => 'bool',
        'expectedActors' => 'array',
        'sections' => 'array',
        'potentialAction' => 'array',
    ];

    /**
     * @var array<string, mixed>
     */
    protected array $options = [
        '@type' => 'MessageCard',
        '@context' => 'https://schema.org/extensions',
        'expectedActors' => [],
        'sections' => [],
        'potentialAction' => [],
    ];

    public function setSections(array $sections): self
    {
        return $this->addSections($sections);
    }

    public function addSections(array $sections): self
    {
        foreach ($sections as $section) {
            $this->addSection($section);
        }

        return $this;
    }

    public function setSection(array $section): self
    {
        return $this->addSection($section);
    }

    public function addSection(array $section): self
    {
        $this->options['sections'][] = configure_options($section, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setDefined([
                    'title',
                    'startGroup',
                    'activityImage',
                    'activityTitle',
                    'activitySubtitle',
                    'activityText',
                    'heroImage',
                    'text',
                    'facts',
                    'images',
                    'potentialAction',
                ])
                ->setAllowedTypes('startGroup', 'bool')
                ->setAllowedTypes('facts', 'array')
                ->setAllowedTypes('images', 'array')
                ->setAllowedTypes('potentialAction', 'array');
        });

        return $this;
    }

    public function setPotentialActions(array $sections): self
    {
        return $this->addPotentialActions($sections);
    }

    public function addPotentialActions(array $sections): self
    {
        foreach ($sections as $section) {
            $this->addPotentialAction($section);
        }

        return $this;
    }

    public function setPotentialAction(array $section): self
    {
        return $this->addPotentialAction($section);
    }

    public function addPotentialAction(array $section): self
    {
        $this->options['potentialAction'][] = configure_options($section, static function (OptionsResolver $optionsResolver): void {
            $optionsResolver
                ->setDefined([
                    '@type',
                    'name',
                    'targets',

                    'target',
                    'headers',
                    'body',
                    'bodyContentType',

                    'inputs',
                    'actions',

                    'addInId',
                    'desktopCommandId',
                    'initializationContext',
                ])
                ->setAllowedTypes('targets', 'array')
                ->setAllowedTypes('headers', 'array')
                ->setAllowedTypes('inputs', 'array')
                ->setAllowedTypes('actions', 'array')
                ->setAllowedTypes('initializationContext', 'array')
                ->addAllowedValues('@type', [
                    'OpenUri',
                    'ActionCard',
                    'HttpPOST',
                    'InvokeAddInCommand',
                ])
                ->addAllowedValues('bodyContentType', [
                    'application/x-www-form-urlencoded',
                    'application/json',
                ]);
        });

        return $this;
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $resolver): void {
            $resolver->setNormalizer('sections', static fn (OptionsResolver $optionsResolver, array $value): array => isset($value[0]) ? $value : [$value]);

            $resolver->setNormalizer('potentialAction', static fn (OptionsResolver $optionsResolver, array $value): array => isset($value[0]) ? $value : [$value]);
        });
    }
}
