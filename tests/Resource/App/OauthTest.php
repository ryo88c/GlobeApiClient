<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Resource\App;

use BEAR\Package\Bootstrap;

class OauthTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \BEAR\Resource\ResourceInterface
     */
    private $resource;

    protected function setUp()
    {
        parent::setUp();
        $app = (new Bootstrap)->getApp('Ryo88c\GlobeApiClient', 'test-app');
        $this->resource = $app->resource;
    }

    public function testOnGet()
    {
        $res = $this->resource->get->uri('app://self/oauth')->withQuery(['code' => 'test'])->eager->request();
        $this->assertInstanceOf('Ryo88c\GlobeApiClient\Resource\App\Oauth', $res);
        $this->assertSame(200, $res->code);
    }

    public function testOnPost()
    {
        $res = $this->resource->post->uri('app://self/oauth')->eager->request();
        $this->assertInstanceOf('Ryo88c\GlobeApiClient\Resource\App\Oauth', $res);
        $this->assertSame(200, $res->code);
    }

    /**
     * @expectedException BEAR\Resource\Exception\MethodNotAllowedException
     */
    public function testOnPut()
    {
        $this->resource->put->uri('app://self/oauth')->eager->request();
    }

    /**
     * @expectedException BEAR\Resource\Exception\MethodNotAllowedException
     */
    public function testOnDelete()
    {
        $this->resource->delete->uri('app://self/oauth')->eager->request();
    }
}
