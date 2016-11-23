<?php

namespace LaravelFr\Tests;

use JsonSerializableMixedResourcesStub;
use LaravelFr\ApiTests\AssertJsonResponse;
use PHPUnit_Framework_TestCase;

class AssertJsonResponseTest extends PHPUnit_Framework_TestCase
{
    use AssertJsonResponse;

    public function testAssertArrayStructureEquals()
    {
        $this->response = new \Illuminate\Http\Response(new JsonSerializableMixedResourcesStub());

        $this->seeJsonStructureEquals([
            'foo',
            'baz'    => ['*' => ['bar' => ['*'], 'foo']],
            'bars'   => ['*' => ['bar', 'foo']],
            'foobar' => ['foobar_foo', 'foobar_bar'],
        ]);
    }

    public function testJsonResponse()
    {
        $this->response = new \Illuminate\Http\Response(new JsonSerializableMixedResourcesStub());

        $this->assertEquals(
            (new JsonSerializableMixedResourcesStub())->jsonSerialize(),
            $this->jsonResponse()
        );
        $this->assertEquals(
            ['foobar_foo' => 'foo', 'foobar_bar' => 'bar'],
            $this->jsonResponse('foobar')
        );
        $this->assertEquals('bar', $this->jsonResponse('foobar.foobar_bar'));
    }
}
