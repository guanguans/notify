<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/notify
 */

namespace Guanguans\Notify\Foundation\Authenticators;

use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriFactoryInterface;

class WebHookAuthenticator extends NullAuthenticator
{
    private UriFactoryInterface $uriFactory;

    public function __construct(
        #[\SensitiveParameter]
        private string $webHook,
        ?UriFactoryInterface $uriFactory = null
    ) {
        $this->uriFactory = $uriFactory ?? new HttpFactory;
    }

    public function applyToRequest(RequestInterface $request): RequestInterface
    {
        return $request->withUri($this->uriFactory->createUri($this->webHook), $request->hasHeader('Host'));
    }
}
