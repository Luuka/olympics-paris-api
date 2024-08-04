<?php

namespace App\Medal;

use App\Country\Continent;
use App\Country\ContinentService;


class ContinentProvider extends AbstractMedalProvider
{
    public function __construct(
        OlympicsProvider $olympicsProvider,
        MedalSorter $medalSorter,
        private readonly ContinentService $continentService
    )
    {
        parent::__construct($olympicsProvider, $medalSorter);
    }

    /**
     * @return array
     */
    public function getMedals(): array
    {
        $medalsByCountry = $this->getMedalsByCountry();

        $medals = [];
        foreach ($medalsByCountry as $countryCode => $country) {
            $continentCode = $this->continentService->getContinent($countryCode);

            $medals = $this->getMedalsCount($medals, $continentCode, $country);
        }

        return $this->medalSorter->sort($medals);
    }

    public function getMedalsByCountryInContinent(Continent $continent): array
    {
        $medalsByCountry = $this->getMedalsByCountry();

        $medals = [];
        foreach (Continent::cases() as $continent){
            $countries = $this->continentService->getCountriesByContinent($continent);

            foreach ($countries as $countryCode) {
                if(isset($medalsByCountry[$countryCode])) {
                    $country = $medalsByCountry[$countryCode];
                    $continentCode = $this->continentService->getContinent($countryCode);

                    if (!isset($medals[$continentCode][$countryCode])) {
                        $medals[$continentCode][$countryCode] = [
                            'gold' => 0,
                            'silver' => 0,
                            'bronze' => 0,
                            'total' => 0,
                        ];
                    }

                    $medals[$continentCode][$countryCode]['gold'] += $country['gold'];
                    $medals[$continentCode][$countryCode]['silver'] += $country['silver'];
                    $medals[$continentCode][$countryCode]['bronze'] += $country['bronze'];
                    $medals[$continentCode][$countryCode]['total'] += $country['total'];
                }
            }

            $medals[$continent->value] = $this->medalSorter->sort($medals[$continent->value]);
        }


        return $medals;

    }
}
