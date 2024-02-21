<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Middleware;

use Guanguans\Notify\Foundation\Contracts\TransferStatsAware;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Response implements TransferStatsAware
{
    use \Guanguans\Notify\Foundation\Concerns\TransferStatsAware;

    public function __invoke(callable $handler): callable
    {
        return static fn (RequestInterface $request, array $options) => $handler($request, $options)->then(
            static function (ResponseInterface $response) use ($request, $options): ResponseInterface {
                $response = \Guanguans\Notify\Foundation\Response::fromPsrResponse($response);

                $response->request = $request;
                $response->cookies = $options[RequestOptions::COOKIES] ?: null;
                $response->transferStats = self::$transferStats;

                return $response;
            }
        );
    }
}
