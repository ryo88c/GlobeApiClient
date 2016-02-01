<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Resource\App;

use BEAR\Resource\ResourceObject;
use Ryo88c\GlobeApiClient\Inject\GlobeApiClientInject;

class Messages extends ResourceObject
{
    use GlobeApiClientInject;

    /**
     * /outbound/{senderAddress}/requests
     *
     * @see https://docs.google.com/document/d/1xQYPFsWSnHY9htIYNL2bENLok8rbAgzxdXsFWbSwE80/pub?embedded=true
     *
     * @return $this
     */
    public function onPost()
    {
        $this['result'] = $this->request();
        return $this;
    }
}
