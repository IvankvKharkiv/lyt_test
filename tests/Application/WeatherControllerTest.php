<?php

namespace App\Tests\Application;

use App\Dto\WeatherResultDto;
use App\Exception\WeatherResponseException;
use App\Service\WeatherService;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use function PHPUnit\Framework\once;

final class WeatherControllerTest extends WebTestCase
{
    #[Test]
    public function itShouldShowWeatherForMadrid(): void
    {
        // Arrange
        $client = static::createClient();
        $weatherServiceMock = $this->createMock(WeatherService::class);
        $weatherServiceMock->expects(once())
            ->method('getWeather')
            ->willReturn(new WeatherResultDto(
                'Madrid',
                'Spain',
                12,
                'cond',
                '20%',
                23,
                new \DateTime('2020-01-01T00:00:00'),
            ));
        self::getContainer()->set('App\Service\WeatherService', $weatherServiceMock);

        // Act
        $crawler = $client->request('GET', 'https://nginx:8080/weather?city=Madrid');

        // Assert
        self::assertStringContainsString('You selected: Madrid', $crawler->html());
    }

    #[Test]
    public function itShouldShowError(): void
    {
        // Arrange
        $client = static::createClient();

        $weatherServiceMock = $this->createMock(WeatherService::class);
        $weatherServiceMock->expects(once())
            ->method('getWeather')
            ->willThrowException(new WeatherResponseException());

        self::getContainer()->set('App\Service\WeatherService', $weatherServiceMock);

        // Act
        $crawler = $client->request('GET', 'https://nginx:8080/weather?city=ErrorCity');

        // Assert
        self::assertStringContainsString('Something went wrong please contact the administrator.', $crawler->html());
    }
}
