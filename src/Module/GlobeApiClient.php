<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Module;

use Ray\Di\Di\Inject;
use GuzzleHttp\ClientInterface;
use BEAR\Resource\Exception\BadRequestException;
use BEAR\Resource\Exception\ResourceNotFoundException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;

class GlobeApiClient implements GlobeApiClientInterface
{
    private $client;

    /**
     * @Inject
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function request($method, $path, array $options = [])
    {
        try {
            $res = $this->client->request($method, $path, $options);
            $statusCode = $res->getStatusCode();
            if ($statusCode === 200 || $statusCode === 201) {
                return json_decode($res->getBody()->getContents(), true);
            } elseif ($statusCode === 204) {
                return null;
            } elseif ($statusCode === 404) {
                throw new ResourceNotFoundException;
            }
            throw new BadRequestException;
        } catch (ClientException $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        } catch (ConnectException $e) {
            throw new ResourceNotFoundException($e->getMessage(), 404, $e);
        }
    }
}
