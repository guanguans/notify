<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpFieldAssignmentTypeMismatchInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpVoidFunctionResultUsedInspection */
/** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

use Guanguans\Notify\NotifyX\Authenticator;
use Guanguans\Notify\NotifyX\Client;
use Guanguans\Notify\NotifyX\Messages\Message;

it('can send message', function (): void {
    $authenticator = new Authenticator('mgo_7Ei9IcBkWYb0bOpRBc6b4JZ1BqiI7');
    $client = new Client($authenticator);
    $message = Message::make([
        'title' => 'This is title.',
        'content' => '> This is content.',
        'description' => 'This is description.',
        // 'team' => '1234567890',
    ]);

    expect($client)
        ->mock([
            response('{"id":1774775558589648923,"message":"消息已加入队列","status":"queued"}', 202),
            response('{"error":"无效的API密钥"}', 401),
            response('{"error":"群组不存在或已被删除"}', 400),
            response(
                <<<'BODY'
                    {"error":"参数错误：Key: 'SimpleSendRequest.Title' Error:Field validation for 'Title' failed on the 'required' tag"}
                    BODY,
                400
            ),
        ])
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
