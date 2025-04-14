<?php

namespace App\Controller;

use App\Service\WeatherService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class WeatherController extends AbstractController
{
    public function __construct(
        private readonly WeatherService $weatherService,
        private readonly LoggerInterface $logger,
    ) {}

    #[Route('/weather', name: 'app_weather', methods: ['GET'])]
    public function weather(#[MapQueryParameter] string $city = ''): Response
    {
        if (empty($city)) {
            return $this->render('weather.html.twig');
        }
        try {
            $weather = $this->weatherService->getWeather($city);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage(), ['exception' => $e, 'city' => $city]);

            return $this->render('weather.html.twig', ['error' => 'Something went wrong please contact the administrator.']);
        }

        return $this->render('weather.html.twig', ['weather' => $weather]);
    }
}
