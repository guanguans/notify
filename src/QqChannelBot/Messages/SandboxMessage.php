<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\QqChannelBot\Messages;

/**
 * @method \Guanguans\Notify\QqChannelBot\Messages\SandboxMessage channelId($channelId)
 * @method \Guanguans\Notify\QqChannelBot\Messages\SandboxMessage content($content)
 * @method \Guanguans\Notify\QqChannelBot\Messages\SandboxMessage image($image)
 * @method \Guanguans\Notify\QqChannelBot\Messages\SandboxMessage fileImage($fileImage)
 * @method \Guanguans\Notify\QqChannelBot\Messages\SandboxMessage msgId($msgId)
 * @method \Guanguans\Notify\QqChannelBot\Messages\SandboxMessage eventId($eventId)
 * @method \Guanguans\Notify\QqChannelBot\Messages\SandboxMessage embed(array $embed)
 * @method \Guanguans\Notify\QqChannelBot\Messages\SandboxMessage ark(array $ark)
 * @method \Guanguans\Notify\QqChannelBot\Messages\SandboxMessage messageReference(array $messageReference)
 * @method \Guanguans\Notify\QqChannelBot\Messages\SandboxMessage markdown(array $markdown)
 */
class SandboxMessage extends Message
{
    public function toHttpUri(): string
    {
        return "https://sandbox.api.sgroup.qq.com/channels/{$this->getOption('channel_id')}/messages";
    }
}
