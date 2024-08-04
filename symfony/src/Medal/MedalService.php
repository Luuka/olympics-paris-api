<?php

namespace App\Medal;

use App\Country\ContinentService;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class MedalService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private ContinentService $continentService
    )
    {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getMedals(): array
    {
        $response = $this->httpClient->request(
            'GET',
            'https://olympics.com/OG2024/data/CIS_MedalNOCs~lang=ENG~comp=OG2024.json',
            options: [
                 "http_version" => "2",
                "headers" => [
                    "User-Agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36"
                ]
            ],
        );

        $nocs = json_decode($response->getContent(), true);

        $medalsByCountry = [];
        foreach ($nocs['medalNOC'] as $noc) {

           if ($noc["gender"] == "TOT" and $noc["sport"] == "GLO") {
               $countryCode = $noc['org'];
               $medalsByCountry = $this->getMedalsCount($medalsByCountry, $countryCode, $noc);
           }
        }


        $medals = [];
        foreach ($medalsByCountry as $countryCode => $country) {
            $continentCode = $this->continentService->getContinent($countryCode);

            $medals = $this->getMedalsCount($medals, $continentCode, $country);
        }

        return $medals;
    }

    /**
     * @param array $medalsByCountry
     * @param mixed $countryCode
     * @param mixed $noc
     * @return array
     */
    public function getMedalsCount(array $medalsByCountry, mixed $countryCode, mixed $noc): array
    {
        if (!isset($medalsByCountry[$countryCode])) {
            $medalsByCountry[$countryCode] = [
                'gold' => 0,
                'silver' => 0,
                'bronze' => 0,
                'total' => 0,
            ];
        }

        $medalsByCountry[$countryCode]['gold'] += $noc['gold'];
        $medalsByCountry[$countryCode]['silver'] += $noc['silver'];
        $medalsByCountry[$countryCode]['bronze'] += $noc['bronze'];
        $medalsByCountry[$countryCode]['total'] += $noc['total'];

        return $medalsByCountry;
    }
}
