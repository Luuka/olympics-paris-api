<?php

namespace App\Controller;

use App\Medal\MedalService;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Throwable;

#[Route('/medals')]
class MedalController extends AbstractController
{
    #[Route('/')]
    public function medals(
        MedalService $medalService,
        CacheInterface $cache,
        CacheItemPoolInterface $cacheItemPool,
    ): JsonResponse
    {
        $medals = [];

        try {
            $medals = $cache->get('medals', function (CacheItem $item) use ($medalService, $cacheItemPool) {
                $item->expiresAfter(3600);
                $medals = $medalService->getMedals();

                $backupItem = $cacheItemPool->getItem('medals-backup')->set($medals);
                $cacheItemPool->save($backupItem);

                return $medals;
            });
        } catch (Throwable) {
            $backup = $cacheItemPool->getItem('medals-backup');

            if($backup->isHit()) {
                $medals = $backup->get();
            }
        }

        return new JsonResponse($medals);
    }
}