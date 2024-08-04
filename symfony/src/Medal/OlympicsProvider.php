<?php

namespace App\Medal;

use LogicException;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

class OlympicsProvider
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheInterface $cache,
        private CacheItemPoolInterface $cacheItemPool,
    )
    {
    }


    public function getOlympicsData(): array
    {
        try {
            return $this->cache->get('olympics_data', function (CacheItemInterface $item) {
                $item->expiresAfter(3600);

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
                $backupItem = $this->cacheItemPool->getItem('olympics_backup')->set($nocs);
                $this->cacheItemPool->save($backupItem);

                return $nocs;
            });
        } catch (Throwable) {
            $backup = $this->cacheItemPool->getItem('olympics_backup');

            if($backup->isHit()) {
                return $backup->get();
            }

            throw new LogicException();
        }
    }
}