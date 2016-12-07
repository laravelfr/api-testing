<?php

namespace LaravelFr\ApiTesting\Tests;

use Illuminate\Http\Response;
use LaravelFr\ApiTesting\Tests\Stubs\JsonSerializableMixedResourcesStub;
use LaravelFr\ApiTesting\AssertJsonResponse;
use LaravelFr\ApiTesting\Tests\Stubs\JsonSerializableTypedResourceStub;
use PHPUnit_Framework_TestCase;

class AssertJsonResponseTest extends PHPUnit_Framework_TestCase
{
    use AssertJsonResponse;

    public function testSeeJsonStructureEquals()
    {
        $this->response = new Response(new JsonSerializableMixedResourcesStub);

        $this->seeJsonStructureEquals([
            'foo',
            'baz'    => ['*' => ['bar' => ['*'], 'foo']],
            'bars'   => ['*' => ['bar', 'foo']],
            'foobar' => ['foobar_foo', 'foobar_bar'],
        ]);
    }

    public function testJsonResponse()
    {
        $this->response = new Response(new JsonSerializableMixedResourcesStub);

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

    public function testSeeJsonTypedStructure()
    {
        $this->response = new Response(new JsonSerializableTypedResourceStub);

        $this->seeJsonTypedStructure([
            'foo' => 'string',
            'bar' => 'integer',
            'foobar' => 'array',
            'baz' => 'boolean',
            'nested_foo' => [
                'foo' => 'string',
                'bar' => 'integer',
                'foobar' => 'array',
                'baz' => 'boolean',
                'double_nested_foo' => [
                    'foo' => 'string',
                    'bar' => 'integer',
                    'foobar' => 'array',
                    'baz' => 'boolean',
                ],
            ],
        ]);
    }
}
