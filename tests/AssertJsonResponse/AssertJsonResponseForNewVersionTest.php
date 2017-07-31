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

    public function setUp()
    {
        if (!class_exists(TestResponse::class)) {
            $this->markTestSkipped('Not compatible with this version.');
        }

        $this->stub = new JsonSerializableMixedResourcesStub;
        $this->response = new TestResponse(new Response($this->stub));
    }

    public function testSeeJsonStructureEquals()
    {
        $this->assertTrue(TestResponse::hasMacro('assertJsonStructureEquals'));

        $this->response->assertJsonStructureEquals($this->stub->structure());
    }

    public function testSeeJsonTypedStructure()
    {
        $this->assertTrue(TestResponse::hasMacro('seeJsonTypedStructure'));

        $this->response->seeJsonTypedStructure($this->stub->typedStructure());
    }

    public function testJsonResponse()
    {
        $this->assertTrue(TestResponse::hasMacro('jsonResponse'));

        $this->assertEquals(['foobar_foo' => 'foo', 'foobar_bar' => 212], $this->response->jsonResponse('foobar'));

        $this->assertEquals(212, $this->response->jsonResponse('foobar.foobar_bar'));
    }
}
