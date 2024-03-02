<?php

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\NotifyTests\XiZhi;

use Guanguans\Notify\XiZhi\Authenticator;
use Guanguans\Notify\XiZhi\Client;
use Guanguans\Notify\XiZhi\Messages\ChannelMessage;
use Guanguans\Notify\XiZhi\Messages\SingleMessage;

beforeEach(function (): void {
    $authenticator = new Authenticator('XZf0db6d069509ec52afc1f3493b76e');
    $this->client = (new Client($authenticator))->mock([
        create_response('{"code":200,"msg":"推送成功"}'),
        create_response('{"code":10000,"msg":"用户不存在"}'),
    ]);
});

it('can send single message', function (): void {
    $singleMessage = SingleMessage::make([
        'title' => 'This is title.',
        'content' => 'This is content.',
    ]);

    expect($this->client)->assertCanSendMessage($singleMessage);
})->group(__DIR__, __FILE__);

it('can send channel message', function (): void {
    $channelMessage = ChannelMessage::make([
        'title' => 'This is title.',
        'content' => 'This is content.',
    ]);

    expect($this->client)->assertCanSendMessage($channelMessage);
})->group(__DIR__, __FILE__);
