<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Module;

use BEAR\Resource\Annotation\AppName;
use BEAR\Resource\SchemeCollection;
use Ray\Di\Di\Inject;
use Ray\Di\InjectorInterface;
use Ray\Di\ProviderInterface;
use Ryo88c\GlobeApiClient\Resource\AppAdapter;

class SchemeCollectionProvider implements ProviderInterface
{
    /**
     * @var string
     */
    private $appName;

    /**
     * @var InjectorInterface
     */
    private $injector;

    /**
     * @param string            $appName
     * @param InjectorInterface $injector
     *
     * @Inject
     * @AppName("appName")
     */
    public function __construct($appName, InjectorInterface $injector)
    {
        $this->appName = $appName;
        $this->injector = $injector;
    }

    /**
     * Return instance
     *
     * @return SchemeCollection
     */
    public function get()
    {
        $schemeCollection = new SchemeCollection;
        $pageAdapter = new AppAdapter($this->injector, $this->appName);
        $appAdapter = new AppAdapter($this->injector, $this->appName);
        $schemeCollection->scheme('page')->host('self')->toAdapter($pageAdapter);
        $schemeCollection->scheme('app')->host('self')->toAdapter($appAdapter);

        return $schemeCollection;
    }
}
