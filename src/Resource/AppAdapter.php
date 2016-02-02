<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Resource;

use BEAR\Resource\AdapterInterface;
use BEAR\Resource\AbstractUri;
use Ray\Di\InjectorInterface;

final class AppAdapter implements AdapterInterface
{
    /**
     * @var InjectorInterface
     */
    private $injector;

    /**
     * Resource adapter namespace
     *
     * @var string
     */
    private $namespace;

    /**
     * Resource adapter path
     *
     * @var string
     */
    private $path;

    private $patterns = [
        'get' => [],
        'post' => [
            '/outbound/[0-9]+/requests' => 'Messages',
        ],
        'put' => [],
        'delete' => [],
    ];

    /**
     * @param InjectorInterface $injector  Application dependency injector
     * @param string            $namespace Resource adapter namespace
     */
    public function __construct(InjectorInterface $injector, $namespace)
    {
        $this->injector = $injector;
        $this->namespace = $namespace;
    }

    /**
     * {@inheritdoc}
     */
    public function get(AbstractUri $uri)
    {
        if (isset($this->patterns[$uri->method])) {
            foreach ($this->patterns[$uri->method] as $regex => $resource) {
                if (!preg_match(sprintf('!^%s\z!', $regex), $uri->path)) {
                    continue;
                }
                $class = sprintf('%s%s\Resource\%s\%s', $this->namespace, $this->path, ucfirst($uri->scheme), $resource);
                $instance = $this->injector->getInstance($class);
                return $instance;
            }
        }

        $class = $this->namespace . $this->path . '\Resource' . str_replace(' ', '\\', ucwords(str_replace('/', ' ', ' ' . $uri->scheme . $uri->path)));
        $instance = $this->injector->getInstance($class);

        return $instance;
    }
}
