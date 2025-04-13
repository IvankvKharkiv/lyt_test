<?php

namespace App\Assembler;

use App\Dto\WeatherResultDto;
use App\Exception\WeatherArrayDataException;

class WeatherDataAssembler
{
    public static function toDto(array $weatherData)
    {
        if (!self::weatherDataIsValid($weatherData)) {
            throw new WeatherArrayDataException('Invalid weather data. Cannot create DTO');
        }

        return new WeatherResultDto(
            $weatherData['location']['name'],
            $weatherData['location']['country'],
            $weatherData['current']['temp_c'],
            $weatherData['current']['condition']['text'],
            $weatherData['current']['humidity'],
            $weatherData['current']['wind_kph'],
            new \DateTime($weatherData['current']['last_updated']),
        );
    }

    public static function weatherDataIsValid(array $weatherData): bool
    {
        if (
            2 !== count(array_intersect(['location', 'current'], array_keys($weatherData)))
            || 2 !== count(array_intersect(['name', 'country'], array_keys($weatherData['location'])))
            || 5 !== count(array_intersect(['temp_c', 'condition', 'humidity', 'wind_kph', 'last_updated'], array_keys($weatherData['current'])))
        ) {
            return false;
        }

        return true;
    }
}
