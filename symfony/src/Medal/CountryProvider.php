<?php

namespace App\Medal;

use App\Country\ContinentService;


class CountryProvider extends AbstractMedalProvider
{

    /**
     * @return array
     */
    public function getMedals(): array
    {
       return $this->getMedalsByCountry();
    }

    public function getMedalsBySports(): array
    {
        $nocs = $this->olympicsProvider->getOlympicsData();

        $medalsByCountry = [];

        foreach ($nocs['medalNOC'] as $noc) {
            if ($noc["gender"] === "TOT" and $noc["sport"] !== "GLO") {
                $countryCode = $noc['org'];
                $sport = $noc['sport'];

                if (!isset($medalsByCountry[$countryCode][$sport])) {
                    $medalsByCountry[$countryCode][$sport] = [
                        'gold' => 0,
                        'silver' => 0,
                        'bronze' => 0,
                        'total' => 0,
                    ];
                }

                $medalsByCountry[$countryCode][$sport]['gold'] += $noc['gold'];
                $medalsByCountry[$countryCode][$sport]['silver'] += $noc['silver'];
                $medalsByCountry[$countryCode][$sport]['bronze'] += $noc['bronze'];
                $medalsByCountry[$countryCode][$sport]['total'] += $noc['total'];
            }
        }

        return $medalsByCountry;
    }

    public function getMedalsByGender(): array
    {
        $nocs = $this->olympicsProvider->getOlympicsData();

        $medalsByGender = [];

        foreach ($nocs['medalNOC'] as $noc) {
            if ($noc["gender"] !== "TOT" and $noc["sport"] === "GLO") {
                $countryCode = $noc['org'];
                $gender = $noc["gender"];

                if (!isset($medalsByGender[$countryCode][$gender])) {
                    $medalsByGender[$countryCode][$gender] = [
                        'gold' => 0,
                        'silver' => 0,
                        'bronze' => 0,
                        'total' => 0,
                    ];
                }

                $medalsByGender[$countryCode][$gender]['gold'] += $noc['gold'];
                $medalsByGender[$countryCode][$gender]['silver'] += $noc['silver'];
                $medalsByGender[$countryCode][$gender]['bronze'] += $noc['bronze'];
                $medalsByGender[$countryCode][$gender]['total'] += $noc['total'];

            }
        }

        return $medalsByGender;
    }
}
