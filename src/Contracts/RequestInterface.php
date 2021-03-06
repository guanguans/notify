<?php

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\Notify\Contracts;

interface RequestInterface
{
    public function getRequestMethod(): string;

    public function getRequestUrl(): string;

    /**
     * @return mixed
     */
    public function getRequestParams();
}
