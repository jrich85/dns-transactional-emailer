<?php

namespace Tests\Support\DataGenerators;

use EndyJasmi\Cuid;
use Faker\Generator;

class InvoiceEmailGenerator implements DataGeneratorContract
{
    private Generator $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    public function generate(): array
    {
        $dateFormat = 'F j, Y';

        return [
            'prefix' => $this->faker->title(),
            'lastName' => $this->faker->lastName(),
            'dueDate' => $this->faker->date($dateFormat),
            'membershipNum' => Cuid::cuid(),
        ];
    }

    public function requiredFields(): array
    {
        return [
            'prefix',
            'lastName',
            'dueDate',
            'membershipNum',
        ];
    }
}
