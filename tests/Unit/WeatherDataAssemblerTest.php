<?php

namespace App\Tests\Unit;

use App\Assembler\WeatherDataAssembler;
use PHPUnit\Framework\TestCase;

class WeatherDataAssemblerTest extends TestCase
{
    public function testToDto(){
        $weatherResponse = [
            'location' => ['name' => 'Madrid', 'country' => 'Spain'],
            'current' => [
                'temp_c' => 12,
                'condition' => ['text' => 'condition'],
                'humidity' => '80%',
                'wind_kph' => 25,
                'last_updated' => '2025-04-13 17:16:18',
            ],
        ];

        $assembler = new WeatherDataAssembler();
        $assembler->toDto($weatherResponse);
    }

}