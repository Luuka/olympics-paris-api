<?php

namespace App\Medal;

use App\Country\ContinentService;

abstract class AbstractMedalProvider
{
    public function __construct(
        protected OlympicsProvider $olympicsProvider,
        protected MedalSorter $medalSorter
    )
    {

    }

    public function getMedalsByCountry(): array
    {
        $nocs = $this->olympicsProvider->getOlympicsData();

        $medalsByCountry = [];
        foreach ($nocs['medalNOC'] as $noc) {

            if ($noc["gender"] === "TOT" and $noc["sport"] === "GLO") {
                $countryCode = $noc['org'];
                $medalsByCountry = $this->getMedalsCount($medalsByCountry, $countryCode, $noc);
            }
        }

        return $this->medalSorter->sort($medalsByCountry);
    }

    /**
     * @param array $medals
     * @param mixed $code
     * @param mixed $noc
     * @return array
     */
    protected function getMedalsCount(array $medals, string $code, array $noc): array
    {
        if (!isset($medals[$code])) {
            $medals[$code] = [
                'gold' => 0,
                'silver' => 0,
                'bronze' => 0,
                'total' => 0,
            ];
        }

        $medals[$code]['gold'] += $noc['gold'];
        $medals[$code]['silver'] += $noc['silver'];
        $medals[$code]['bronze'] += $noc['bronze'];
        $medals[$code]['total'] += $noc['total'];

        return $medals;
    }
}