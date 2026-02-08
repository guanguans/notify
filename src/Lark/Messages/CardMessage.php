<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Lark\Messages;

/**
 * @method self cardLink(array $cardLink)
 * @method self config(array $config)
 * @method self elements(array $elements)
 * @method self header(array $header)
 * @method self i18nElements(array $i18nElements)
 */
class CardMessage extends AbstractMessage
{
    /** @var list<string> */
    protected array $defined = [
        'header',
        'elements',
        'i18n_elements',
        'config',
        'card_link',
    ];

    /** @var array<string, list<string>|string> */
    protected array $allowedTypes = [
        'header' => 'array',
        'elements' => 'array',
        'i18n_elements' => 'array',
        'config' => 'array',
        'card_link' => 'array',
    ];

    /**
     * @return array<string, mixed>
     */
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
