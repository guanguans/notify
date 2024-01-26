<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\GoogleChat\Messages;

use Guanguans\Notify\Foundation\Concerns\AsJson;
use Guanguans\Notify\Foundation\Concerns\AsPost;
use Guanguans\Notify\GoogleChat\Credential;

/**
 * @method \Guanguans\Notify\GoogleChat\Messages\Message text($text)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message cards($cards)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message name($name)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message sender($sender)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message createTime($createTime)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message lastUpdateTime($lastUpdateTime)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message previewText($previewText)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message annotations($annotations)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message thread($thread)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message space($space)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message fallbackText($fallbackText)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message actionResponse($actionResponse)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message argumentText($argumentText)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message slashCommand($slashCommand)
 * @method \Guanguans\Notify\GoogleChat\Messages\Message attachment($attachment)
 */
class Message extends \Guanguans\Notify\Foundation\Message
{
    use AsPost;
    use AsJson;

    protected array $defined = [
        'text',
        'cards',
        'name',
        'sender',
        'createTime',
        'lastUpdateTime',
        'previewText',
        'annotations',
        'thread',
        'space',
        'fallbackText',
        'actionResponse',
        'argumentText',
        'slashCommand',
        'attachment',
    ];

    protected array $allowedTypes = [
        'cards' => 'array',
        'sender' => 'array',
        'annotations' => 'array',
        'thread' => 'array',
        'space' => 'array',
        'actionResponse' => 'array',
        'slashCommand' => 'array',
        'attachment' => 'array',
    ];

    public function httpUri(): string
    {
        return sprintf('https://chat.googleapis.com/v1/spaces/%s/messages', Credential::TEMPLATE_SPACE);
    }
}
