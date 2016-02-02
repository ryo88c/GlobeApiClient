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
    static private $endpoint = 'https://devapi.globelabs.com.ph/smsmessaging/v1';

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

    private function request()
    {
        $options = [];
        if (!empty($this->uri->query)) {
            if ($this->uri->method === 'get') {
                $options['query'] = $this->uri->query;
            } elseif ($this->uri->method === 'post') {
                $options['form_params'] = $this->uri->query;
            } else {
                $options['body'] = http_build_query($this->uri->query, '', '&');
            }
        }
        if (!isset($options['query'])) {
            $options['query'] = [];
        }
        $options['query']['access_token'] = $_ENV['GLOBE_API_TOKEN'];
        return $this->apiClient->request($this->uri->method, self::$endpoint . $this->uri->path, $options);
    }
}
