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
 * @method self correlationId($correlationId)
 * @method self expectedActors(array $expectedActors)
 * @method self originator($originator)
 * @method self summary($summary)
 * @method self themeColor($themeColor)
 * @method self hideOriginalBody(bool $hideOriginalBody)
 * @method self title($title)
 * @method self text($text)
 * @method self sections(array $sections)
 * @method self potentialAction(array $potentialAction)
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

    public function addSection(array $section): self
    {
        $this->options['sections'][] = $this->configureAndResolveOptions(
            $section,
            static function (OptionsResolver $optionsResolver): void {
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
            }
        );

        return $this;
    }

    public function addPotentialAction(array $section): self
    {
        $this->options['potentialAction'][] = $this->configureAndResolveOptions(
            $section,
            static function (OptionsResolver $optionsResolver): void {
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
            }
        );

        return $this;
    }

    public function toHttpUri(): string
    {
        // return 'webhook';
        return '';
    }

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setNormalizer('sections', static fn (
            OptionsResolver $optionsResolver,
            array $value
        ): array => isset($value[0]) ? $value : [$value]);

        $optionsResolver->setNormalizer('potentialAction', static fn (
            OptionsResolver $optionsResolver,
            array $value
        ): array => isset($value[0]) ? $value : [$value]);
    }
}
