<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\DingTalkGroupBot\Messages;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\TextMessage content($content)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\TextMessage atMobiles($atMobiles)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\TextMessage atDingtalkIds($atDingtalkIds)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\TextMessage isAtAll($isAtAll)
 */
class TextMessage extends Message
{
    protected array $defined = [
        'content',
        'atMobiles',
        'atDingtalkIds',
        'isAtAll',
    ];

    protected array $allowedTypes = [
        'atMobiles' => ['int', 'string', 'array'],
        'atDingtalkIds' => ['int', 'string', 'array'],
        'isAtAll' => 'bool',
    ];

    protected function configureOptionsResolver(OptionsResolver $optionsResolver): OptionsResolver
    {
        return tap(parent::configureOptionsResolver($optionsResolver), static function (OptionsResolver $resolver): void {
            $resolver->setNormalizer('atMobiles', static fn (OptionsResolver $optionsResolver, $value): array => (array) $value);
            $resolver->setNormalizer('atDingtalkIds', static fn (OptionsResolver $optionsResolver, $value): array => (array) $value);
        });
    }

    protected function type(): string
    {
        return 'text';
    }
}
