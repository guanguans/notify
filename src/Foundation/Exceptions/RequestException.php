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

if (method_exists(GuzzleRequestException::class, 'wrapException')) {
    /**
     * @api
     *
     * @codeCoverageIgnore
     */
    class RequestException extends GuzzleRequestException implements Throwable
    {
        /**
         * @noinspection PhpUndefinedMethodInspection
         */
        public static function wrapException(RequestInterface $request, \Throwable $e): GuzzleRequestException
        {
            return self::fromGuzzleRequestException(parent::wrapException($request, $e));
        }

        /**
         * @param array<string, mixed> $handlerContext
         */
        public static function createFromResponse(
            Response $response,
            ?\Throwable $previous = null,
            array $handlerContext = [],
            ?BodySummarizerInterface $bodySummarizer = null
        ): self {
            $request = $response->request();
            \assert($request instanceof RequestInterface);

            return self::create($request, $response, $previous, $handlerContext, $bodySummarizer);
        }

        /**
         * @param array<string, mixed> $handlerContext
         *
         * @noinspection PhpHierarchyChecksInspection
         * @noinspection PhpParameterNameChangedDuringInheritanceInspection
         * @noinspection PhpMethodParametersCountMismatchInspection
         */
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

        /**
         * @noinspection PhpPossiblePolymorphicInvocationInspection
         * @noinspection PhpUndefinedMethodInspection
         * @noinspection PhpMethodParametersCountMismatchInspection
         */
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
} else {
    /**
     * @api
     */
    class RequestException extends GuzzleRequestException implements Throwable
    {
        public static function createFromResponse(
            Response $response,
            ?\Throwable $previous = null,
            ?BodySummarizerInterface $bodySummarizer = null
        ): self {
            $request = $response->request();
            \assert($request instanceof RequestInterface);

            return self::create($request, $response, $previous, $bodySummarizer);
        }

        public static function create(
            #[\SensitiveParameter]
            RequestInterface $request,
            #[\SensitiveParameter]
            ?ResponseInterface $response = null,
            #[\SensitiveParameter]
            ?\Throwable $previous = null,
            ?BodySummarizerInterface $bodySummarizer = null
        ): self {
            return self::fromGuzzleRequestException(parent::create($request, $response, $previous, $bodySummarizer));
        }

        /**
         * @see \GuzzleHttp\Exception\RequestException::__construct()
         */
        public static function fromGuzzleRequestException(GuzzleRequestException $requestException): self
        {
            return $requestException instanceof self ? $requestException : new self(
                $requestException->getMessage(),
                $requestException->getRequest(),
                $requestException->getCode(),
                $requestException->getPrevious(),
            );
        }
    }
}
