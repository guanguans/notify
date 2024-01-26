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
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\SingleActionCardMessage title($title)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\SingleActionCardMessage text($text)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\SingleActionCardMessage singleTitle($singleTitle)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\SingleActionCardMessage singleURL($singleURL)
 * @method \Guanguans\Notify\DingTalkGroupBot\Messages\SingleActionCardMessage btnOrientation($btnOrientation)
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
