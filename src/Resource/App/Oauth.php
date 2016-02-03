<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Resource\App;

use BEAR\Resource\ResourceObject;
use Ryo88c\GlobeApiClient\Inject\GlobeApiClientInject;
use BEAR\Sunday\Inject\ResourceInject;

class Oauth extends ResourceObject
{
    use GlobeApiClientInject;
    use ResourceInject;

    private $endpoint = 'https://developer.globelabs.com.ph';

    public function onGet()
    {
        $res = $this->resource->post->uri('app://self/oauth')
            ->withQuery([
                'app_id' => $_ENV['GLOBE_API_ID'],
                'app_secret' => $_ENV['GLOBE_API_SECRET'],
                'code' => $this->uri->query['code']
            ])->request();
        if (isset($res['result']['error'])) {
            throw new BadRequestException($res['result']['error']);
        }
        $this['result'] = $this->registerAccessToken($res['result']);
        return $this;
    }

    public function onPost()
    {
        $this['result'] = $this->request('access_token');
        return $this;
    }
}
