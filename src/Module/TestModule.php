<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Module;

use Ray\Di\AbstractModule;
use Ryo88c\GlobeApiClient\Fake\Module\FakeGlobeApiClient;

class TestModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind(GlobeApiClientInterface::class)->to(FakeGlobeApiClient::class);
    }
}
