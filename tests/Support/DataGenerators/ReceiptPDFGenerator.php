<?php

namespace Tests\Support\DataGenerators;

use EndyJasmi\Cuid;
use Faker\Generator;

class ReceiptPDFGenerator implements DataGeneratorContract
{
    private Generator $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    public function generate(): array
    {
        if (is_null($this->faker)) {
            $this->faker = resolve(Generator::class);
        }

        $dateFormat = 'F j, Y';

        $data = [
            'fullName' => $this->faker->name(),
            'personalIncorporation' => $this->faker->company(),
            'address1' => $this->faker->address(),
            'address2' => '',
            'city' => $this->faker->city(),
            'province' => strtoupper($this->faker->randomLetter().$this->faker->randomLetter()),
            'postalCode' => $this->faker->postcode(),
            'membershipNum' => Cuid::cuid(),
            'fiscalStartDate' => $this->faker->date($dateFormat),
            'fiscalEndDate' => $this->faker->date($dateFormat),
            'dateReceived' => $this->faker->date($dateFormat),
            'planType' => $this->faker->sentence(3),
            'amount' => $this->faker->numberBetween(100, 2000)
        ];

        return $data;
    }

    public function requiredFields(): array
    {
        return [
            'fullName',
            'address1',
            'city',
            'province',
            'postalCode',
            'membershipNum',
            'fiscalStartDate',
            'fiscalEndDate',
            'dateReceived',
            'planType',
            'amount'
        ];
    }
}
