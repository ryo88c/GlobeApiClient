<?php

namespace Ryo88c\GlobeApiClient\Module;

use BEAR\Package\PackageModule;
use Ray\Di\AbstractModule;
use josegonzalez\Dotenv\Loader as Dotenv;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use BEAR\Resource\SchemeCollectionInterface;
use BEAR\Resource\ResourceInterface;
use Ryo88c\GlobeApiClient\Resource\Resource;

class AppModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $dotEnvPath = dirname(dirname(__DIR__)) . '/.env';
        if (file_exists($dotEnvPath) && is_readable($dotEnvPath)) {
            Dotenv::load([
                'filepath' => $dotEnvPath,
                'toEnv' => true
            ]);
        }
        $this->install(new PackageModule);
        $this->bind(ClientInterface::class)->to(Client::class);
        $this->bind(GlobeApiClientInterface::class)->to(GlobeApiClient::class);
        $this->bind(SchemeCollectionInterface::class)->toProvider(SchemeCollectionProvider::class);
        $this->bind(ResourceInterface::class)->to(Resource::class);
    }
}
