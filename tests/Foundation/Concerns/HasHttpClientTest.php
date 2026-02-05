<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
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

use Guanguans\Notify\AnPush\Authenticator;
use Guanguans\Notify\AnPush\Messages\Message;
use Guanguans\Notify\Foundation\Client;
use Guanguans\Notify\Foundation\Exceptions\BadMethodCallException;
use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use GuzzleHttp\HandlerStack;

it('will throw InvalidArgumentException when argument is empty', function (): void {
    /** @noinspection PhpParamsInspection */
    (new Client)->verify();
})
    ->group(__DIR__, __FILE__)
    ->throws(InvalidArgumentException::class, \sprintf('The method [%s::verify] only accepts 1 argument, 0 given.', Client::class));

it('will throw BadMethodCallException when calling an undefined method', function (): void {
    /** @noinspection PhpUndefinedMethodInspection */
    (new Client)->foo();
})
    ->group(__DIR__, __FILE__)
    ->throws(BadMethodCallException::class, \sprintf('The method [%s::foo] does not exist.', Client::class));

it('can set http client', function (): void {
    expect(new Client)
        ->setHttpClient(new GuzzleHttp\Client)->toBeInstanceOf(Client::class);
})->group(__DIR__, __FILE__);

it('can set http client resolver', function (): void {
    expect(new Client)
        ->setHttpClientResolver(
            static fn (Client $client): GuzzleHttp\Client => new GuzzleHttp\Client,
        )
        ->toBeInstanceOf(Client::class);
})->group(__DIR__, __FILE__);

it('can set handler stack', function (): void {
    expect(new Client)
        ->setHandlerStack(HandlerStack::create())->toBeInstanceOf(Client::class);
})->group(__DIR__, __FILE__);

it('can set handler stack resolver', function (): void {
    expect(new Client)
        ->setHandlerStackResolver($handlerStack = HandlerStack::create())->toBeInstanceOf(Client::class)
        ->getHandlerStackResolver()->toBe($handlerStack);
})->group(__DIR__, __FILE__);

it('can mock response', function (): void {
    $authenticator = new Authenticator('FE3LGGYQZXRZ6A50BN66M42H0BY');
    $client = new Guanguans\Notify\AnPush\Client($authenticator);
    $message = Message::make([
        'title' => 'This is title.',
        'content' => 'This is content.',
        'channel' => '94412',
        // 'to' => 'ov_1i8jk39d****',
    ]);

    expect($client)
        ->mock()
        ->assertCanSendMessage($message)
        ->mock(response('{"msg":"success","code":200,"data":{"msgIds":[{"channelId":"94412","msgId":1715333937401}]}}'))
        ->assertCanSendMessage($message);
})->group(__DIR__, __FILE__);
