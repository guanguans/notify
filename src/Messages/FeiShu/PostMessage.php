<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Messages\FeiShu;

use Guanguans\Notify\Messages\Message;

class PostMessage extends Message
{
    protected string $type = 'post';

    /**
     * @var array<string>
     */
    protected array $defined = [
        'post',
    ];

    /**
     * @var array<string, string>
     */
    protected array $allowedTypes = [
        'post' => 'array',
    ];

    public function __construct(array $post)
    {
        parent::__construct([
            'post' => $post,
        ]);
    }

    /**
     * @return array{msg_type: mixed, content: array<mixed>}
     */
    public function transformToRequestParams(): array
    {
        return [
            'msg_type' => $this->type,
            'content' => $this->getOptions(),
        ];
    }
}
