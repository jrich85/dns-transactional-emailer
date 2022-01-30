<?php

namespace Tests\Support\DataGenerators;

use EndyJasmi\Cuid;
use Faker\Generator;

class ReceiptEmailGenerator implements DataGeneratorContract
{
    private Generator $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    public function generate(): array
    {
        return [
            'prefix' => $this->faker->title(),
            'lastName' => $this->faker->lastName(),
        ];
    }

    public function requiredFields(): array
    {
        return [
            'prefix',
            'lastName',
        ];
    }
}
