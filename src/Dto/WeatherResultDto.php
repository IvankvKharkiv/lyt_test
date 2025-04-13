<?php

namespace App\Dto;

class WeatherResultDto
{
    public function __construct(
        public readonly string $city,
        public readonly string $country,
        public readonly int $temperature,
        public readonly string $condition,
        public readonly string $humidity,
        public readonly int $wind_speed,
        public readonly \DateTimeInterface $last_updated,
    ) {}
}
