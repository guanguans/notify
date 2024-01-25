<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Guanguans\Notify\XiZhi\Client;
use Guanguans\Notify\XiZhi\Credential;
use Guanguans\Notify\XiZhi\Messages\SingleMessage;
use GuzzleHttp\Handler\MockHandler;

use function Pest\Faker\faker;

it('can send single message', function (): void {
    $credential = new Credential('XZd60aea56567ae39a1b1920cbc42bb');
    $client = new Client($credential);
    // $singleMessage = new SingleMessage('测试标题', '测试内容');
    $singleMessage = new SingleMessage(faker()->title(), faker()->text());
    $mockHandler = new MockHandler([
        (new GuzzleHttp\Psr7\HttpFactory())->createResponse(
            200,
            '{"code":200,"msg":"推送成功"}'
        ),
        (new GuzzleHttp\Psr7\HttpFactory())->createResponse(
            200,
            '{"code":10000,"msg":"用户不存在"}'
        ),
    ]);

    expect($client)
        ->setHandler($mockHandler)
        ->send($singleMessage)->toBeInstanceOf(Psr\Http\Message\ResponseInterface::class)
        ->send($singleMessage)->toBeInstanceOf(Psr\Http\Message\ResponseInterface::class);
})->group(__DIR__, __FILE__);
