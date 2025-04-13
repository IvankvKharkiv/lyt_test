<?php

namespace App\Service;

use App\Assembler\WeatherDataAssembler;
use App\Client\WeatherClient;
use App\Dto\WeatherResultDto;

class WeatherService
{
    public function __construct(private WeatherClient $weatherClient)
    {
    }

    public function getWeather(string $cityName): WeatherResultDto
    {
        return WeatherDataAssembler::toDto($this->weatherClient->getWeather($cityName));
    }

}