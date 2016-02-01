<?php
/**
 * This file is part of the Ryo88c\GlobeApiClient package
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ryo88c\GlobeApiClient\Resource\App;

use BEAR\Package\Bootstrap;

class MessagesTest extends \PHPUnit_Framework_TestCase
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

    public function testOnPost()
    {
        $res = $this->resource->post->uri('app://self/outbound/123/requests')->eager->request();
        $this->assertInstanceOf('Ryo88c\GlobeApiClient\Resource\App\Messages', $res);
        $this->assertSame(200, $res->code);
    }

    /**
     * @expectedException BEAR\Resource\Exception\ResourceNotFoundException
     */
    public function testOnPostUnFormat()
    {
        $this->resource->post->uri('app://self/outbound/12a/requests')->eager->request();
    }
}
