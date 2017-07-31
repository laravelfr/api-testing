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
        $this->response = new Response(new JsonSerializableMixedResourcesStub);
    }

    public function testSeeJsonStructureEquals()
    {
        $this->seeJsonStructureEquals([
            'foo',
            'baz'    => ['*' => ['bar' => ['*'], 'foo']],
            'bars'   => ['*' => ['bar', 'foo']],
            'foobar' => ['foobar_foo', 'foobar_bar'],
        ]);
    }

    public function testJsonResponse()
    {
        $this->assertEquals(
            (new JsonSerializableMixedResourcesStub)->jsonSerialize(),
            $this->jsonResponse()
        );
        $this->assertEquals(
            ['foobar_foo' => 'foo', 'foobar_bar' => 'bar'],
            $this->jsonResponse('foobar')
        );
        $this->assertEquals('bar', $this->jsonResponse('foobar.foobar_bar'));
    }
}
