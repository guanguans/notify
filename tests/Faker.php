<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/notify.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\NotifyTests;

use Faker\Factory;
use Faker\Generator;

trait Faker
{
    final protected static function faker(string $locale = 'en_US'): Generator
    {
        /**
         * @var array<string, Generator> $fakers
         */
        static $fakers = [];

        if (! \array_key_exists($locale, $fakers)) {
            $faker = Factory::create($locale);

            $faker->seed(9001);

            $fakers[$locale] = $faker;
        }

        return $fakers[$locale];
    }
}
