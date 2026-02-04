<?php

/** @noinspection PhpInternalEntityUsedInspection */
/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUnhandledExceptionInspection */
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

namespace Guanguans\NotifyTests\Foundation;

use Guanguans\Notify\AnPush\Authenticator;
use Guanguans\Notify\AnPush\Messages\Message;
use Guanguans\Notify\Foundation\Authenticators\NullAuthenticator;
use Guanguans\Notify\Foundation\Client;
use Guanguans\Notify\Foundation\Concerns\AsNullUri;
use Illuminate\Support\Collection;
use Pest\Expectation;
use Psr\Http\Message\ResponseInterface;

it('can dump debug info', function (): void {
    expect(new class extends Client {
        use AsNullUri;
    })->dump()->toBeInstanceOf(Client::class);
})->group(__DIR__, __FILE__);

it('can set Authenticator', function (): void {
    expect(new class extends Client {})
        ->setAuthenticator($authenticator = new NullAuthenticator)->toBeInstanceOf(Client::class)
        ->getAuthenticator()->toBe($authenticator);
})->group(__DIR__, __FILE__);

it('can concurrent send messages', function (): void {
    $authenticator = new Authenticator('FE3LGGYQZXRZ6A50BN66M42H0BY');
    $client = new \Guanguans\Notify\AnPush\Client($authenticator);
    $message = Message::make([
        'title' => 'This is title.',
        'content' => 'This is content.',
        'channel' => '94412',
        // 'to' => 'ov_1i8jk39d****',
    ]);
    $body = '{"msg":"success","code":200,"data":{"msgIds":[{"channelId":"94412","msgId":1715333937401}]}}';

    ['messages' => $messages, 'mock' => $mock] = Collection::times(5)->reduce(
        static function (array $carry) use ($message, $body): array {
            $carry['messages'][] = $message;
            $carry['mock'][] = response($body);

            return $carry;
        },
        []
    );

    expect($client)
        ->mock($mock)
        ->pool($messages)
        ->each(
            fn (Expectation $expectation) => $expectation
                ->toBeInstanceOf(ResponseInterface::class)
                ->body()->toBe($body)
                ->status()->toBe(200)
        );
})->group(__DIR__, __FILE__);
