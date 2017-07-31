<?php

namespace LaravelFr\ApiTesting\Tests\AssertJsonResponse;

use Illuminate\Http\Response;
use PHPUnit_Framework_TestCase;
use LaravelFr\ApiTesting\AssertJsonResponse;
use Illuminate\Foundation\Testing\TestResponse;
use LaravelFr\ApiTesting\Tests\Stubs\JsonSerializableMixedResourcesStub;

class AssertJsonResponseForNewVersionTest extends PHPUnit_Framework_TestCase
{
    use AssertJsonResponse;

    private $response;

    public function setUp()
    {
        if (!class_exists(TestResponse::class)) {
            $this->markTestSkipped('Not compatible with this version.');
        }
        $this->response = new TestResponse(new Response(new JsonSerializableMixedResourcesStub));
    }

    public function testSeeJsonStructureEquals()
    {
        $this->assertTrue(TestResponse::hasMacro('seeJsonStructureEquals'));

        $this->response->seeJsonStructureEquals([
            'foo',
            'baz' => ['*' => ['bar' => ['*'], 'foo']],
            'bars' => ['*' => ['bar', 'foo']],
            'foobar' => ['foobar_foo', 'foobar_bar'],
        ]);
    }

    public function testJsonResponse()
    {
        $this->assertTrue(TestResponse::hasMacro('jsonResponse'));

        $this->assertEquals(
            (new JsonSerializableMixedResourcesStub)->jsonSerialize(),
            $this->response->jsonResponse()
        );

        $this->assertEquals(['foobar_foo' => 'foo', 'foobar_bar' => 'bar'], $this->response->jsonResponse('foobar'));

        $this->assertEquals('bar', $this->response->jsonResponse('foobar.foobar_bar'));
    }
}
