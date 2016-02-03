<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Inject;

use Ray\Di\Di\Inject;
use Ryo88c\GlobeApiClient\Module\GlobeApiClientInterface;

trait GlobeApiClientInject
{
    private $defaultEndpoint = 'https://devapi.globelabs.com.ph';

    /**
     * @var GlobeApiClientInterface
     */
    private $apiClient;

    /**
     * @Inject
     */
    public function setClient(GlobeApiClientInterface $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    private function embedAccessToken($options = [])
    {
        if (!isset($this->uri->query['subscriber'])) {
            return;
        }
        $accessTokens = $this->getAccessTokens();
        if (isset($accessTokens[$this->uri->query['subscriber']])) {
            if (!isset($options['query'])) {
                $options['query'] = [];
            }
            $options['query']['access_token'] = $accessTokens[$this->uri->query['subscriber']];
        }
        unset($this->uri->query['subscriber']);
        return $options;
    }

    private function request($path = null)
    {
        $options = $this->embedAccessToken();
        if (!empty($this->uri->query)) {
            if ($this->uri->method === 'get') {
                if (isset($options['query'])) {
                    $options['query'] = array_merge($options['query'], $this->uri->query);
                } else {
                    $options['query'] = $this->uri->query;
                }
            } elseif ($this->uri->method === 'post') {
                $options['form_params'] = $this->uri->query;
            } else {
                $options['body'] = http_build_query($this->uri->query, '', '&');
            }
        }
        return $this->apiClient->request($this->uri->method, $this->createUri($path), $options);
    }

    private function createUri($path)
    {
        $endpoint = empty($this->endpoint) ? $this->defaultEndpoint : $this->endpoint;
        $apiType = isset($this->apiType) ? $this->apiType : strtolower(end(explode('\\', get_class())));
        if (isset($this->version)) {
            $uri = sprintf('%s/%s/%s%s', $endpoint, $apiType, $this->version, $path);
        } else {
            $uri = sprintf('%s/%s/%s', $endpoint, $apiType, $path);
        }
        return $uri;
    }

    private function registerAccessToken($args)
    {
        $accessTokens = $this->getAccessTokens();
        $accessTokens[$args['subscriber_number']] = $args['access_token'];
        return file_put_contents($this->getAccessTokenFilePath(), json_encode($accessTokens));
    }

    private function getAccessTokens()
    {
        $jsonFilePath = $this->getAccessTokenFilePath();
        if (file_exists($jsonFilePath) && is_readable($jsonFilePath)) {
            $accessTokens = json_decode(file_get_contents($jsonFilePath), true);
        }
        if (!isset($accessTokens) || empty($accessTokens)) {
            $accessTokens = [];
        }
        return $accessTokens;
    }

    private function getAccessTokenFilePath()
    {
        return dirname(dirname(__DIR__)) . '/var/conf/access_tokens.json';
    }
}
