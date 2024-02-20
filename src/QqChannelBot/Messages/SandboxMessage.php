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
 * @method self channelId($channelId)
 * @method self content($content)
 * @method self image($image)
 * @method self fileImage($fileImage)
 * @method self msgId($msgId)
 * @method self eventId($eventId)
 * @method self embed(array $embed)
 * @method self ark(array $ark)
 * @method self messageReference(array $messageReference)
 * @method self markdown(array $markdown)
 */
class SandboxMessage extends Message
{
    public function toHttpUri(): string
    {
        return "https://sandbox.api.sgroup.qq.com/channels/{$this->getOption('channel_id')}/messages";
    }
}
