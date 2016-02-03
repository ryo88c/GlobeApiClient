<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Resource\App;

use BEAR\Resource\ResourceObject;
use Ryo88c\GlobeApiClient\Inject\GlobeApiClientInject;

class Location extends ResourceObject
{
    use GlobeApiClientInject;

    private $version = 'v1';

    /**
     * /queries/location
     *
     * @see https://docs.google.com/document/d/1UUut5jbmdatDOi9I1znKSSHKywPWZ1oXussg7AlnXik/pub?embedded=true
     *
     * @return $this
     */
    public function onGet()
    {
        $this['result'] = $this->request('/queries/location');
        return $this;
    }
}
