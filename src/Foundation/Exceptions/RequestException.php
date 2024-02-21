<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Foundation\Exceptions;

use GuzzleHttp\BodySummarizerInterface;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestException extends GuzzleRequestException
{
    public static function wrapException(RequestInterface $request, \Throwable $e): GuzzleRequestException
    {
        return static::fromGuzzleRequestException(parent::wrapException($request, $e));
    }

    public static function create(
        RequestInterface $request,
        ?ResponseInterface $response = null,
        ?\Throwable $previous = null,
        array $handlerContext = [],
        ?BodySummarizerInterface $bodySummarizer = null
    ): self {
        return static::fromGuzzleRequestException(parent::create(
            $request,
            $response,
            $previous,
            $handlerContext,
            $bodySummarizer
        ));
    }

    public static function fromGuzzleRequestException(GuzzleRequestException $requestException): self
    {
        return $requestException instanceof static ? $requestException : new static(
            $requestException->getMessage(),
            $requestException->getRequest(),
            $requestException->getResponse(),
            $requestException->getPrevious(),
            $requestException->getHandlerContext(),
        );
    }
}
