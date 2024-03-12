<?php

/** @noinspection OffsetOperationsInspection */
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

namespace Guanguans\NotifyTests\Foundation\Concerns;

use Guanguans\Notify\Foundation\Concerns\AsNullUri;
use Guanguans\Notify\Foundation\Exceptions\BadMethodCallException;
use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use Guanguans\Notify\Foundation\Message;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

it('will throw InvalidArgumentException when argument is empty', function (): void {
    expect(new class(['foo' => 'bar']) extends Message {
        use AsNullUri;
        protected array $required = ['foo'];
    })->foo();
})
    ->group(__DIR__, __FILE__)
    ->throws(InvalidArgumentException::class);

it('will throw BadMethodCallException when calling an undefined method', function (): void {
    expect(new class(['foo' => 'bar']) extends Message {
        use AsNullUri;
        protected array $defined = ['foo'];
    })->bar();
})
    ->group(__DIR__, __FILE__)
    ->throws(BadMethodCallException::class);

it('can get options', function (): void {
    expect(new class(['foo' => 'foo']) extends Message {
        use AsNullUri;
        protected array $defaults = ['foo' => 'bar'];
        protected array $required = ['foo'];
        protected array $defined = ['foo', 'bar'];
        protected array $deprecated = [
            'foo',
            'bar' => ['foo/bar', '2.0', 'The option "%name%" is deprecated.'],
        ];
        protected array $normalizers = [];
        protected array $allowedValues = ['foo' => ['foo', 'bar']];
        protected array $allowedTypes = ['foo' => ['string']];
        protected array $infos = ['foo' => 'Invalid foo.'];

        public function defaults(): array
        {
            return [
                'foo' => 'bar',
                'bar' => static function (OptionsResolver $optionsResolver): void {},
            ];
        }

        public function deprecated(): array
        {
            return [
                'foo',
                'bar' => ['foo/bar', '2.0', 'The option "%name%" is deprecated.'],
            ];
        }

        public function normalizers(): array
        {
            return [
                'foo' => static fn (Options $options, string $value): string => strtoupper($value),
            ];
        }
    })
        ->getOptions()->toBeArray()
        ->getValidatedOptions()->toBeArray();
})->group(__DIR__, __FILE__);

it('can array access', function (): void {
    $message = new class(['foo' => 'bar']) extends Message {
        use AsNullUri;
        protected array $defined = ['foo'];
    };

    expect(isset($message['foo']))->toBeTrue()
        ->and($message['foo'])->toBe('bar');

    $message['foo'] = 'baz';
    expect($message['foo'])->toBe('baz');

    unset($message['foo']);
    expect(isset($message['foo']))->toBeFalse();
})->group(__DIR__, __FILE__);
