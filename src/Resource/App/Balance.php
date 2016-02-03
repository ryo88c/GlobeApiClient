<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Resource\App;

use BEAR\Resource\ResourceObject;
use Ryo88c\GlobeApiClient\Inject\GlobeApiClientInject;

class Balance extends ResourceObject
{
    use GlobeApiClientInject;

    private $version = 'v1';

    private $apiType = 'location';

    /**
     * /queries/balance
     *
     * @see https://docs.google.com/document/d/1WrY0MLU09xaNlU50qyIr9ovqUGvuNT04tDirSUkSJ7s/pub?embedded=true
     *
     * @return $this
     */
    public function onGet()
    {
        $this['result'] = $this->request('/queries/balance');
        return $this;
    }
}
