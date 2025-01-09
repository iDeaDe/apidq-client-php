<?php

namespace ApiDQ\Factory;

use ApiDQ\Builder\ClientBuilder;
use ApiDQ\Client;
use ApiDQ\Exception\Client\BuilderException;
use Psr\Cache\CacheItemPoolInterface;

class SimpleClientFactory
{
    /**
     * @param string $apiUrl
     * @param string $apiToken
     * @param string $apiSecret
     * @return Client
     * @throws BuilderException
     */
    public static function createClient(string $apiUrl, string $apiToken, string $apiSecret): Client
    {
        return ClientBuilder::create()
            ->setApiUrl($apiUrl)
            ->setApiToken($apiToken)
            ->setApiSecret($apiSecret)
            ->build();
    }

    /**
     * @param string $apiUrl
     * @param string $apiToken
     * @param string $apiSecret
     * @param CacheItemPoolInterface $cache
     * @return Client
     * @throws BuilderException
     */
    public static function createClientWithCache(
        string $apiUrl,
        string $apiToken,
        string $apiSecret,
        CacheItemPoolInterface $cache
    ): Client {
        return ClientBuilder::create()
            ->setApiUrl($apiUrl)
            ->setApiToken($apiToken)
            ->setApiSecret($apiSecret)
            ->setCache($cache)
            ->build();
    }

    /**
     * @param string $apiUrl
     * @param string $apiToken
     * @param string $apiSecret
     * @param string $cacheDirPath
     * @return Client
     * @throws BuilderException
     */
    public static function createClientWithFileCache(
        string $apiUrl,
        string $apiToken,
        string $apiSecret,
        string $cacheDirPath
    ): Client {
        return ClientBuilder::create()
            ->setApiUrl($apiUrl)
            ->setApiToken($apiToken)
            ->setApiSecret($apiSecret)
            ->setCacheDirPath($cacheDirPath)
            ->build();
    }
}
