<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CurrencyConvertTest extends TestCase
{
    public function testConvertSuccess()
    {
        // Arrange
        $source = 'TWD';
        $target = 'JPY';
        $amount = '$1000';
        $expected = '$3,669.00';

        // Act
        $response = $this->getJson("/api/convert?source={$source}&target={$target}&amount={$amount}");

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'msg' => 'success',
            'amount' => $expected
        ]);
    }

    public function testConvertFail()
    {
        // Arrange
        $source = 'USD';
        $target = 'EUR';
        $amount = '$1000';

        // Act
        $response = $this->getJson("/api/convert?source={$source}&target={$target}&amount={$amount}");

        // Assert
        $response->assertStatus(400);
        $response->assertJson([
            'msg' => 'Invalid currency'
        ]);
    }

    public function testAmountIsRequired()
    {
        // Arrange
        $source = 'TWD';
        $target = 'JPY';

        // Act
        $response = $this->getJson("/api/convert?source={$source}&target={$target}");

        // Assert
        $response->assertStatus(422);
        $response->assertJson(
            fn (AssertableJson $json) => $json
                ->has('message')
                ->has('errors.amount')
                ->etc()
        );
    }
}
