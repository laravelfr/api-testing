<?php

namespace LaravelFr\ApiTesting\Tests;

use LaravelFr\ApiTesting\AssertArrays;
use LaravelFr\ApiTesting\Tests\Stubs\JsonSerializableMixedResourcesStub;
use PHPUnit_Framework_TestCase;

class AssertArraysTest extends PHPUnit_Framework_TestCase
{
    use AssertArrays;

    public function testAssertArrayStructureEquals()
    {
        $array = (new JsonSerializableMixedResourcesStub)->jsonSerialize();

        $this->assertArrayStructureEquals([
            'foo',
            'baz'    => ['*' => ['bar' => ['*'], 'foo']],
            'bars'   => ['*' => ['bar', 'foo']],
            'foobar' => ['foobar_foo', 'foobar_bar'],
        ], $array);
    }
}
