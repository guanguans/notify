<?php

/** @noinspection OffsetOperationsInspection */

/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\NotifyTests\Foundation;

use Guanguans\Notify\Foundation\Concerns\AsNullUri;
use Guanguans\Notify\Foundation\Exceptions\BadMethodCallException;
use Guanguans\Notify\Foundation\Exceptions\InvalidArgumentException;
use Guanguans\Notify\Foundation\Message;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

it('will throw InvalidArgumentException when argument is empty', function (): void {
    expect(new class(['foo' => 'bar']) extends Message {
        use AsNullUri;

        // protected array $defined = ['foo'];
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

it('can get options', function (): void {
    expect(new class([
        'foo' => 'bar',
        'bar' => ['type' => 'memory'],
    ]) extends Message {
        use AsNullUri;

        protected array $defaults = ['foo' => 'bar'];

        protected array $required = ['foo'];

        protected array $defined = ['foo', 'bar'];

        protected bool $ignoreUndefined = true;

        protected array $deprecated = [
            'foo',
            'bar' => ['foo/bar', '2.0', 'The option "%name%" is deprecated.'],
        ];

        protected array $normalizers = [];

        protected array $allowedValues = ['foo' => ['bar', 'baz']];

        protected array $allowedTypes = ['foo' => ['string']];

        protected array $infos = ['foo' => 'invalid foo'];

        public function __construct(array $options = [])
        {
            parent::__construct($options);
            $this->normalizers['foo'] = static fn (Options $options, string $value): string => strtoupper($value);
            $this->defaults['bar'] = static function (OptionsResolver $optionsResolver, Options $options): void {
                $optionsResolver->setDefaults([
                    'type' => 'file',
                    'path' => 'path/to/file',
                ]);
                $optionsResolver->setAllowedValues('type', ['file', 'memory']);
                $optionsResolver->setAllowedTypes('path', 'string');
            };
        }
    })->getOptions()->toBeArray();
})->group(__DIR__, __FILE__);

it('can dump debug info', function (): void {
    expect(new class(['foo' => 'bar']) extends Message {
        use AsNullUri;

        protected array $defined = ['foo'];
    })->dump()->toBeInstanceOf(Message::class);
})->group(__DIR__, __FILE__);
