<?php

namespace App\Controller;

use App\Country\Continent;
use App\Medal\ContinentProvider;
use App\Medal\CountryProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/medals')]
class MedalController extends AbstractController
{
    #[Route('/continents')]
    public function continents(
        ContinentProvider $provider,
    ): JsonResponse
    {
        $medals = $provider->getMedals();
        return new JsonResponse($medals);
    }

    #[Route('/continents/countries')]
    public function continentsCountries(
        ContinentProvider $provider,
    ): JsonResponse
    {
        $medals = $provider->getMedalsByCountryInContinent(Continent::EU);
        return new JsonResponse($medals);
    }

    #[Route('/countries')]
    public function countriesMedals(
        CountryProvider $provider,
    ): JsonResponse
    {
        $medals = $provider->getMedals();
        return new JsonResponse($medals);
    }
    #[Route('/countries/sports')]
    public function countriesSportsMedals(
        CountryProvider $provider,
    ): JsonResponse
    {
        $medals = $provider->getMedalsBySports();
        return new JsonResponse($medals);
    }

    #[Route('/countries/genders')]
    public function countriesGenderMedals(
        CountryProvider $provider,
    ): JsonResponse
    {
        $medals = $provider->getMedalsByGender();
        return new JsonResponse($medals);
    }
}