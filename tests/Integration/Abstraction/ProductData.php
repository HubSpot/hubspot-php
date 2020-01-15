<?php

namespace SevenShores\Hubspot\Tests\Integration\Abstraction;

trait ProductData
{
    protected function getData(string $name = 'A new product'): array
    {
        return [
            ['name' => 'name', 'value' => $name],
            ['name' => 'description', 'value' => 'A description of this product.'],
            ['name' => 'price',  'value' => 27.50],
            ['name' => 'recurringbillingfrequency',  'value' => 'quarterly'],
        ];
    }
}
