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

/**
 * @method self title($title)
 * @method self text($text)
 * @method self singleTitle($singleTitle)
 * @method self singleURL($singleURL)
 * @method self btnOrientation($btnOrientation)
 */
class SingleActionCardMessage extends Message
{
    protected array $defined = [
        'title',
        'text',
        'singleTitle',
        'singleURL',
        'btnOrientation',
    ];

    protected array $options = [
        'btnOrientation' => 0,
    ];

    protected function type(): string
    {
        return 'actionCard';
    }
}
