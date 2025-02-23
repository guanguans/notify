<?php

declare(strict_types=1);

namespace Pest\Faker;

use Faker\Factory;
use Faker\Generator;


if (! function_exists('Pest\Faker\faker')) {
    function faker(string $locale = Factory::DEFAULT_LOCALE): Generator
    {
        return fake($locale);
    }
}


if (! function_exists('Pest\Faker\fake')) {
    function fake(string $locale = Factory::DEFAULT_LOCALE): Generator
    {
        return Factory::create($locale);
    }
}

