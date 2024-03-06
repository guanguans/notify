<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Lark\Messages;

/**
 * @method self header(array $header)
 * @method self elements(array $elements)
 * @method self i18nElements(array $i18nElements)
 * @method self config(array $config)
 * @method self cardLink(array $cardLink)
 */
class CardMessage extends Message
{
    protected array $defined = [
        'header',
        'elements',
        'i18n_elements',
        'config',
        'card_link',
    ];

    protected array $allowedTypes = [
        'header' => 'array',
        'elements' => 'array',
        'i18n_elements' => 'array',
        'config' => 'array',
        'card_link' => 'array',
    ];

    protected function toPayload(): array
    {
        $payload = parent::toPayload();

        return [
            'msg_type' => $payload['msg_type'],
            'card' => $payload['content'],
        ];
    }

    protected function type(): string
    {
        return 'interactive';
    }
}
