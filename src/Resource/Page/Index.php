<?php

namespace Ryo88c\GlobeApiClient\Resource\Page;

use BEAR\Resource\ResourceObject;

class Index extends ResourceObject
{
    public function onGet($name = 'BEAR.Sunday')
    {
        $this['greeting'] = 'Hello ' . $name;

        return $this;
    }
}
