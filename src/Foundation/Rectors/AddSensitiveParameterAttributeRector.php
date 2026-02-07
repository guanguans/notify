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
use PhpParser\Node;
use PhpParser\Node\Param;
use Rector\Php82\Rector\Param\AddSensitiveParameterAttributeRector as OriginalAddSensitiveParameterAttributeRector;
use Rector\PHPStan\ScopeFetcher;
use Rector\Rector\AbstractRector;

/**
 * @internal
 */
final class AddSensitiveParameterAttributeRector extends AbstractRector
{
    private readonly OriginalAddSensitiveParameterAttributeRector $originalAddSensitiveParameterAttributeRector;

    public function __construct(OriginalAddSensitiveParameterAttributeRector $originalAddSensitiveParameterAttributeRector)
    {
        $this->originalAddSensitiveParameterAttributeRector = clone $originalAddSensitiveParameterAttributeRector;
        $this->originalAddSensitiveParameterAttributeRector->configure([
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
                'webHook',
            ],
        ]);
    }

    public function getNodeTypes(): array
    {
        // return $this->addSensitiveParameterAttributeRector->getNodeTypes();
        return [Param::class];
    }

    /**
     * @param \PhpParser\Node\Param $node
     *
     * @throws \Rector\Exception\ShouldNotHappenException
     */
    public function refactor(Node $node): ?Node
    {
        $scope = ScopeFetcher::fetch($node);

        if (!$scope->getClassReflection()?->getNativeReflection()->isSubclassOf(Authenticator::class)) {
            return null;
        }

        return $this->originalAddSensitiveParameterAttributeRector->refactor($node);
    }
}
