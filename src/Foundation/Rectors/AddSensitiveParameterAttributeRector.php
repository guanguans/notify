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

namespace Guanguans\Notify\Foundation\Rectors;

use Guanguans\Notify\Foundation\Contracts\Authenticator;
use Guanguans\RectorRules\Rector\AbstractProxyRector;
use PhpParser\Node;
use PhpParser\Node\Param;
use Rector\Php82\Rector\Param\AddSensitiveParameterAttributeRector as OriginalAddSensitiveParameterAttributeRector;
use Rector\PHPStan\ScopeFetcher;

/**
 * @internal
 */
final class AddSensitiveParameterAttributeRector extends AbstractProxyRector
{
    /**
     * @return list<\Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample>
     */
    protected function codeSamples(): array
    {
        return [];
    }

    /**
     * @param \PhpParser\Node\Param $node
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Rector\Exception\ShouldNotHappenException
     */
    protected function rawRefactor(Node $node): ?Node
    {
        $scope = ScopeFetcher::fetch($node);

        if (!$scope->getClassReflection()?->getNativeReflection()->isSubclassOf(Authenticator::class)) {
            return null;
        }

        $this->makeProxyRector()->configure([
            OriginalAddSensitiveParameterAttributeRector::SENSITIVE_PARAMETERS => [
                'accessToken',
                'apiKey',
                'botApiKey',
                'clientSecret',
                'key',
                'password',
                'pushKey',
                'secret',
                'tempKey',
                'token',
                'usernameOrToken',
                'webHook',
            ],
        ]);

        return parent::rawRefactor($node);
    }

    protected function proxyRectorClass(): string
    {
        return OriginalAddSensitiveParameterAttributeRector::class;
    }
}
