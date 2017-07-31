<?php

namespace LaravelFr\ApiTesting\Tests\AssertJsonResponse;

use Illuminate\Http\Response;
use PHPUnit_Framework_TestCase;
use LaravelFr\ApiTesting\AssertJsonResponse;
use Laravel\BrowserKitTesting\Concerns\MakesHttpRequests;
use LaravelFr\ApiTesting\Tests\Stubs\JsonSerializableMixedResourcesStub;

class AssertJsonResponseForOldVersionAndBrowserKitTest extends PHPUnit_Framework_TestCase
{
    use AssertJsonResponse, MakesHttpRequests;

    public function setUp()
    {
        $this->stub = new JsonSerializableMixedResourcesStub;
        $this->response = new Response($this->stub);
    }

    public function testSeeJsonStructureEquals()
    {
        $this->assertJsonStructureEquals($this->stub->structure());
    }

    public function testJsonResponse()
    {
        $this->assertEquals(
            ['foobar_foo' => 'foo', 'foobar_bar' => 212],
            $this->jsonResponse('foobar')
        );
        $this->assertEquals(212, $this->jsonResponse('foobar.foobar_bar'));
    }

    public function testSeeJsonTypedStructure()
    {
        $this->seeJsonTypedStructure($this->stub->typedStructure());
    }
}
