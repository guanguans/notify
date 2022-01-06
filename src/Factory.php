<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify;

use Guanguans\Notify\Support\Str;

/**
 * Class Factory.
 *
 * @method static \Guanguans\Notify\Clients\BarkClient          bark(array $options = [])
 * @method static \Guanguans\Notify\Clients\ChanifyClient       chanify(array $options = [])
 * @method static \Guanguans\Notify\Clients\DingTalkClient      dingTalk(array $options = [])
 * @method static \Guanguans\Notify\Clients\FeiShuClient        feiShu(array $options = [])
 * @method static \Guanguans\Notify\Clients\GitterClient        gitter(array $options = [])
 * @method static \Guanguans\Notify\Clients\GoogleChatClient    googleChat(array $options = [])
 * @method static \Guanguans\Notify\Clients\LoggerClient        logger(array $options = [])
 * @method static \Guanguans\Notify\Clients\MailerClient        mailer(array $options = [])
 * @method static \Guanguans\Notify\Clients\MattermostClient    mattermost(array $options = [])
 * @method static \Guanguans\Notify\Clients\NowPushClient       nowPush(array $options = [])
 * @method static \Guanguans\Notify\Clients\PushPlusClient      pushPlus(array $options = [])
 * @method static \Guanguans\Notify\Clients\RocketChatClient    rocketChat(array $options = [])
 * @method static \Guanguans\Notify\Clients\ServerChanClient    serverChan(array $options = [])
 * @method static \Guanguans\Notify\Clients\WeWorkClient        weWork(array $options = [])
 * @method static \Guanguans\Notify\Clients\XiZhiClient         xiZhi(array $options = [])
 * @method static \Guanguans\Notify\Clients\ZulipClient         zulip(array $options = [])
 */
class Factory
{
    /**
     * @param $name
     *
     * @return mixed
     */
    public static function make($name, array $options = [])
    {
        $client = sprintf('\\Guanguans\\Notify\\Clients\\%sClient', Str::studly($name));

        return new $client($options);
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}
