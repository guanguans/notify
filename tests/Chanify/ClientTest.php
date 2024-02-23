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

namespace Guanguans\NotifyTests\Chanify;

use Guanguans\Notify\Chanify\Authenticator;
use Guanguans\Notify\Chanify\Client;
use Guanguans\Notify\Chanify\Messages\LinkMessage;
use Guanguans\Notify\Chanify\Messages\TextMessage;
use Psr\Http\Message\ResponseInterface;

it('can send text message', function (): void {
    $authenticator = new Authenticator('CICwhbIGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFIgIIAQ.orHlBVavQPrY-ZP3eqQKDgjyTtNdZPdNYV6lpAx8');
    $client = new Client($authenticator);
    $message = TextMessage::make([
        'title' => 'This is title.',
        'text' => 'This is text.',
        // 'copy' => 'This is copy.',
        // 'actions' => [
        //     'ActionName1|http://<action host>/<action1>',
        //     'ActionName2|http://<action host>/<action2>',
        // ],
        // 'autocopy' => 0,
        // 'sound' => 0,
        // 'priority' => 10,
    ]);

    expect($client)
        ->mock([
            create_response('{"request-uid":"03fe6123-2098-4af8-a210-658010a69d9c"}'),
            create_response('{"res":400,"msg":"bad request"}', 400),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);

it('can send link message', function (): void {
    $authenticator = new Authenticator('CICwhbIGEiJBQVdIWlVKS1JORVY0UlVETFZYVVpRTlNLTlVZVlZPT1JFIgIIAQ.orHlBVavQPrY-ZP3eqQKDgjyTtNdZPdNYV6lpAx8');
    $client = new Client($authenticator);
    $message = LinkMessage::make([
        'link' => 'https://github.com/guanguans/notify',
        // 'sound' => 0,
        // 'priority' => 10,
    ]);

    expect($client)
        ->mock([
            create_response('{"request-uid":"03fe6123-2098-4af8-a210-658010a69d9c"}'),
            create_response('{"res":400,"msg":"bad request"}', 400),
        ])
        ->send($message)->toBeInstanceOf(ResponseInterface::class)
        ->send($message)->toBeInstanceOf(ResponseInterface::class);
})->group(__DIR__, __FILE__);
