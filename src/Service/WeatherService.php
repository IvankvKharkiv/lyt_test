<?php

namespace App\Service;

use App\Assembler\WeatherDataAssembler;
use App\Client\WeatherClient;
use App\Dto\WeatherResultDto;
use Psr\Log\LoggerInterface;

class WeatherService
{
    public function __construct(
        private WeatherClient $weatherClient,
        private LoggerInterface $logger
    ) {}

    public function getWeather(string $cityName): WeatherResultDto
    {
        $weatherResultDto = WeatherDataAssembler::toDto($this->weatherClient->getWeather($cityName));

        $this->logger->emergency("Weather result for {$cityName}.", ['weatherData'=> $weatherResultDto]);

        return $weatherResultDto;
    }
}
