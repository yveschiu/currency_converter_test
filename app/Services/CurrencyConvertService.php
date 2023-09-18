<?php

namespace App\Services;

use Exception;

class CurrencyConvertService
{
    protected array $currencies = [
        'TWD' => ['TWD' => 1, 'JPY' => 3.669, 'USD' => 0.03281],
        'JPY' => ['TWD' => 0.26956, 'JPY' => 1, 'USD' => 0.00885],
        'USD' => ['TWD' => 30.444, 'JPY' => 111.801, 'USD' => 1],
    ];

    public function convert(float $amount, string $source, string $target): float
    {
        if (!isset($this->currencies[$source]) || !isset($this->currencies[$target])) {
            throw new Exception('Invalid currency');
        }
        return round($amount * $this->currencies[$source][$target], 2);
    }
}
