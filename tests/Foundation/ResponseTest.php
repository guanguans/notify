<?php

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * Copyright (c) 2021-2024 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\NotifyTests\Foundation;

use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use Guanguans\Notify\Foundation\Exceptions\LogicException;
use Guanguans\Notify\Foundation\Exceptions\RequestException;
use Guanguans\Notify\Foundation\Exceptions\RuntimeException;
use Guanguans\Notify\Foundation\Response;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\TransferStats;
use Illuminate\Support\Collection;
use Psr\Http\Message\RequestInterface;
use function Pest\Faker\faker;

it('can dump debug info', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->dump()->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('can convert to string', function (): void {
    /** @noinspection ToStringCallInspection */
    expect((string) Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))->toBeString();
})->group(__DIR__, __FILE__);

it('can convert to json data', function (): void {
    expect(
        Response::fromPsrResponse(
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                json_encode(['foo' => 'bar'], \JSON_THROW_ON_ERROR),
            ),
        )->json('foo'),
    )->toBeString();
})->group(__DIR__, __FILE__);

it('can convert to array', function (): void {
    expect(
        Response::fromPsrResponse(
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                json_encode(['foo' => 'bar'], \JSON_THROW_ON_ERROR),
            ),
        )->array(),
    )->toBeArray();
})->group(__DIR__, __FILE__);

it('can convert to object', function (): void {
    expect(
        Response::fromPsrResponse(
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                json_encode(['foo' => 'bar'], \JSON_THROW_ON_ERROR),
            ),
        )->object(),
    )->toBeInstanceOf(\stdClass::class);
})->group(__DIR__, __FILE__);

it('can convert to xml', function (): void {
    expect(
        Response::fromPsrResponse(
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                <<<'XML'
                    <document>
                     <title>foo</title>
                    </document>
                    XML
            ),
        )->xml(),
    )->toBeInstanceOf(\SimpleXMLElement::class);
})->group(__DIR__, __FILE__);

it('will throw RuntimeException when illuminate/collections is not installed', function (): void {
    $this
        ->getFunctionMock(class_namespace(Response::class), 'class_exists')
        ->expects($this->once())
        ->willReturn(false);

    Response::fromPsrResponse(
        new \GuzzleHttp\Psr7\Response(
            200,
            [],
            json_encode(['foo' => 'bar'], \JSON_THROW_ON_ERROR),
        ),
    )->collect();
})
    ->group(__DIR__, __FILE__)
    ->throws(RuntimeException::class);

it('can convert to collect', function (): void {
    expect(
        Response::fromPsrResponse(
            new \GuzzleHttp\Psr7\Response(
                200,
                [],
                json_encode(['foo' => 'bar'], \JSON_THROW_ON_ERROR),
            ),
        )->collect(),
    )->toBeInstanceOf(Collection::class);
})->group(__DIR__, __FILE__);

it('can convert to data url', function (): void {
    expect(
        Response::fromPsrResponse(
            new \GuzzleHttp\Psr7\Response(
                200,
                ['Content-Type' => 'image/png'],
                file_get_contents(fixtures_path('image.png')),
            ),
        )->dataUrl(),
    )->toBe('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyBAMAAADsEZWCAAAAG1BMVEXMzMyWlpaqqqq3t7exsbGcnJy+vr6jo6PFxcUFpPI/AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAQUlEQVQ4jWNgGAWjgP6ASdncAEaiAhaGiACmFhCJLsMaIiDAEQEi0WXYEiMCOCJAJIY9KuYGTC0gknpuHwXDGwAA5fsIZw0iYWYAAAAASUVORK5CYII=');
})->group(__DIR__, __FILE__);

it('will throw InvalidArgumentException when save to null', function (): void {
    Response::fromPsrResponse(
        new \GuzzleHttp\Psr7\Response(
            200,
            ['Content-Type' => 'image/png'],
            file_get_contents(fixtures_path('image.png')),
        ),
    )->saveAs(null);
})
    ->group(__DIR__, __FILE__)
    ->throws(InvalidArgumentException::class);

it('will throw LogicException when save to unable open the resource', function (): void {
    $this
        ->getFunctionMock(class_namespace(Response::class), 'fopen')
        ->expects($this->once())
        ->willReturn(false);

    Response::fromPsrResponse(
        new \GuzzleHttp\Psr7\Response(
            200,
            ['Content-Type' => 'image/png'],
            file_get_contents(fixtures_path('image.png')),
        ),
    )->saveAs(faker()->filePath());
})
    ->group(__DIR__, __FILE__)
    ->throws(LogicException::class);

it('can save to resource or file', function (): void {
    /** @noinspection PhpVoidFunctionResultUsedInspection */
    expect(
        Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(
            200,
            ['Content-Type' => 'image/png'],
            file_get_contents(fixtures_path('image.png')),
        )),
    )
        ->saveAs(fopen('php://temp', 'wb+'))->toBeNull()
        ->saveAs(fixtures_path('image-copy.png'))->toBeNull();
})->group(__DIR__, __FILE__);

it('can detect content type', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'application/json'])))
        ->is('json')->toBeTrue()
        ->and(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'application/xml'])))
        ->is('xml')->toBeTrue()
        ->and(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'text/html'])))
        ->is('html')->toBeTrue()
        ->and(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'image/png'])))
        ->is('image')->toBeTrue()
        ->and(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'audio/mpeg'])))
        ->is('audio')->toBeTrue()
        ->and(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'video/mp4'])))
        ->is('video')->toBeTrue()
        ->and(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'text/plain'])))
        ->is('text')->toBeTrue()
        ->and(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'text/plain'])))
        ->is('foo')->toBeFalse();
})->group(__DIR__, __FILE__);

it('can get header', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'application/json'])))
        ->header('Content-Type')->toBe('application/json');
})->group(__DIR__, __FILE__);

it('can get headers', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'application/json'])))
        ->headers()->toBeArray();
})->group(__DIR__, __FILE__);

it('can get reason', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'application/json'])))
        ->reason()->toBeString();
})->group(__DIR__, __FILE__);

it('can get effective uri', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(200, ['Content-Type' => 'application/json'])))
        ->effectiveUri()->toBeNull();
})->group(__DIR__, __FILE__);

it('can detect response status', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->successful()->toBeTrue()
        ->redirect()->toBeFalse()
        ->failed()->toBeFalse()
        ->clientError()->toBeFalse()
        ->serverError()->toBeFalse();
})->group(__DIR__, __FILE__);

it('can apply callback on error', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(500)))
        ->onError(static fn (): string => 'callback')->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('will throw LogicException repeat set request', function (): void {
    $response = Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response);
    $response->request(\Mockery::spy(RequestInterface::class));
    $response->request(\Mockery::spy(RequestInterface::class));
})
    ->group(__DIR__, __FILE__)
    ->throws(LogicException::class);

it('can get/set request', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->request()->toBeNull()
        ->request(\Mockery::spy(RequestInterface::class))->toBeInstanceOf(RequestInterface::class);
})->group(__DIR__, __FILE__);

it('will throw LogicException repeat set cookies', function (): void {
    $response = Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response);
    $response->cookies(\Mockery::spy(CookieJar::class));
    $response->cookies(\Mockery::spy(CookieJar::class));
})
    ->group(__DIR__, __FILE__)
    ->throws(LogicException::class);

it('can get/set cookies', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->cookies()->toBeNull()
        ->cookies(\Mockery::spy(CookieJar::class))->toBeInstanceOf(CookieJar::class);
})->group(__DIR__, __FILE__);

it('will throw LogicException repeat set transferStats', function (): void {
    $response = Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response);
    $transferStats = new TransferStats(\Mockery::spy(RequestInterface::class));
    $response->transferStats($transferStats);
    $response->transferStats($transferStats);
})
    ->group(__DIR__, __FILE__)
    ->throws(LogicException::class);

it('can get/set transferStats', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->transferStats()->toBeNull()
        ->transferStats(new TransferStats(\Mockery::spy(RequestInterface::class)))->toBeInstanceOf(TransferStats::class);
})->group(__DIR__, __FILE__);

it('can close the body', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->close()->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('can convert to exception', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->toException()->toBeNull()
        ->and(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(500)))
        ->request(new Request('GET', faker()->url()))->toBeInstanceOf(RequestInterface::class)
        ->toException()->toBeInstanceOf(RequestException::class);
})->group(__DIR__, __FILE__);

it('will throw RequestException when response fail', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->throw()->toBeInstanceOf(Response::class)
        ->and(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(500)))
        ->request(new Request('GET', faker()->url()))->toBeInstanceOf(RequestInterface::class)
        ->throw(static fn (): string => 'callback');
})
    ->group(__DIR__, __FILE__)
    ->throws(RequestException::class);

it('can throw RequestException when condition is truthy', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->throwIf(true)->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('can throw RequestException when is given status', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->throwIfStatus(static fn (): int => 500)->toBeInstanceOf(Response::class)
        ->throwIfStatus(500)->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('can throw RequestException when is not given status', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->throwUnlessStatus(static fn (): int => 200)->toBeInstanceOf(Response::class)
        ->throwUnlessStatus(200)->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('can throw RequestException when client error', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->throwIfClientError()->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('can throw RequestException when server error', function (): void {
    expect(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response))
        ->throwIfServerError()->toBeInstanceOf(Response::class);
})->group(__DIR__, __FILE__);

it('will throw LogicException when array access set', function (): void {
    Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response)['foo'] = 'baz';
})
    ->group(__DIR__, __FILE__)
    ->throws(LogicException::class);

it('will throw LogicException when array access unset', function (): void {
    unset(Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response)['foo']);
})
    ->group(__DIR__, __FILE__)
    ->throws(LogicException::class);

it('can array access', function (): void {
    $response = Response::fromPsrResponse(new \GuzzleHttp\Psr7\Response(
        200,
        [],
        json_encode(['foo' => 'bar'], \JSON_THROW_ON_ERROR),
    ));

    expect(isset($response['foo']))->toBeTrue()
        ->and($response['foo'])->toBe('bar');
})->group(__DIR__, __FILE__);
