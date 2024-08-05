<?php

namespace App\Sound;

use LogicException;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

class SoundProvider
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheInterface $cache,
        private CacheItemPoolInterface $cacheItemPool,
    )
    {
    }

    public function getSoundUrl(): string
    {
        try {
            return $this->cache->get('sound_data', function (CacheItemInterface $item) {
                $item->expiresAfter(3600);

                $response = $this->httpClient->request(
                    'GET',
                    'https://api.deezer.com/track/6907156'
                );

                $previewUrl = json_decode($response->getContent(), true)['preview'];
                $backupItem = $this->cacheItemPool->getItem('sound_backup')->set($previewUrl);
                $this->cacheItemPool->save($backupItem);

                return $previewUrl;
            });
        } catch (Throwable) {
            $backup = $this->cacheItemPool->getItem('sound_backup');

            if($backup->isHit()) {
                return $backup->get();
            }

            throw new LogicException();
        }
    }
}