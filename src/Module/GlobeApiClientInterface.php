<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Module;

interface GlobeApiClientInterface
{
    public function request($method, $uri, array $options = []);
}
