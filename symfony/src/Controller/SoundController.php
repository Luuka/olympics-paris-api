<?php

namespace App\Controller;

use App\Sound\SoundProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sounds')]
class SoundController extends AbstractController
{
    #[Route('/france')]
    public function continents(
        SoundProvider $provider,
    ): JsonResponse
    {
        $url = $provider->getSoundUrl();
        return new JsonResponse(['preview' => $url]);
    }
}