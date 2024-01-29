<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\MicrosoftTeams\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method \Guanguans\Notify\MicrosoftTeams\Messages\Message correlationId($correlationId)
 * @method \Guanguans\Notify\MicrosoftTeams\Messages\Message expectedActors(array $expectedActors)
 * @method \Guanguans\Notify\MicrosoftTeams\Messages\Message originator($originator)
 * @method \Guanguans\Notify\MicrosoftTeams\Messages\Message summary($summary)
 * @method \Guanguans\Notify\MicrosoftTeams\Messages\Message themeColor($themeColor)
 * @method \Guanguans\Notify\MicrosoftTeams\Messages\Message hideOriginalBody($hideOriginalBody)
 * @method \Guanguans\Notify\MicrosoftTeams\Messages\Message title($title)
 * @method \Guanguans\Notify\MicrosoftTeams\Messages\Message text($text)
 * @method \Guanguans\Notify\MicrosoftTeams\Messages\Message sections(array $sections)
 * @method \Guanguans\Notify\MicrosoftTeams\Messages\Message potentialAction(array $potentialAction)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsJson;
    use AsPost;

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

    protected array $required = [
    ];

    protected $allowedTypes = [
        'hideOriginalBody' => 'bool',
        'expectedActors' => 'array',
        'sections' => 'array',
        'potentialAction' => 'array',
    ];

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

    public function toHttpUri()
    {
        return 'webhook';
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $resolver): void {
            $resolver->setNormalizer('sections', static fn (OptionsResolver $optionsResolver, array $value): array => isset($value[0]) ? $value : [$value]);

            $resolver->setNormalizer('potentialAction', static fn (OptionsResolver $optionsResolver, array $value): array => isset($value[0]) ? $value : [$value]);
        });
    }
}
