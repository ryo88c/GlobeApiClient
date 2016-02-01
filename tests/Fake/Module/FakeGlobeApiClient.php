<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Fake\Module;

use Ryo88c\GlobeApiClient\Module\GlobeApiClientInterface;

class FakeGlobeApiClient implements GlobeApiClientInterface
{
    public function request($method, $path, array $options = [])
    {
        return true;
    }
}
