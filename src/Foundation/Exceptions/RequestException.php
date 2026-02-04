<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation\Exceptions;

use Guanguans\Notify\Foundation\Contracts\Throwable;
use Guanguans\Notify\Foundation\Response;
use GuzzleHttp\BodySummarizerInterface;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestException extends GuzzleRequestException implements Throwable
{
    public static function wrapException(RequestInterface $request, \Throwable $e): GuzzleRequestException
    {
        return self::fromGuzzleRequestException(parent::wrapException($request, $e));
    }

    public static function createFromResponse(
        Response $response,
        ?\Throwable $previous = null,
        array $handlerContext = [],
        ?BodySummarizerInterface $bodySummarizer = null
    ): self {
        return self::create($response->request(), $response, $previous, $handlerContext, $bodySummarizer);
    }

    public static function create(
        RequestInterface $request,
        ?ResponseInterface $response = null,
        ?\Throwable $previous = null,
        array $handlerContext = [],
        ?BodySummarizerInterface $bodySummarizer = null
    ): self {
        return self::fromGuzzleRequestException(parent::create(
            $request,
            $response,
            $previous,
            $handlerContext,
            $bodySummarizer,
        ));
    }

    public static function fromGuzzleRequestException(GuzzleRequestException $requestException): self
    {
        return $requestException instanceof self ? $requestException : new self(
            $requestException->getMessage(),
            $requestException->getRequest(),
            $requestException->getResponse(),
            $requestException->getPrevious(),
            $requestException->getHandlerContext(),
        );
    }
}
