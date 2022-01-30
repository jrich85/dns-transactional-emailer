<?php

namespace Tests\Support\DataGenerators;

interface DataGeneratorContract
{
    public function generate(): array;

    public function requiredFields(): array;
}
