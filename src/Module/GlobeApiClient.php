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
     * smsmessaging メッセージの送信
     * location 位置情報, 課金残高
     * payment 決済
     * voice 音声（受付）
     * oauth 認証（受付）
     * demand メッセージ受信（受付）
     */

    /**
     * @Inject
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function request($method, $uri, array $options = [])
    {
        try {
            $res = $this->client->request($method, $uri, $options);
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
