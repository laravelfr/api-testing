<?php

namespace LaravelFr\ApiTesting\Tests;

use PHPUnit_Framework_TestCase;
use LaravelFr\ApiTesting\AssertArrays;
use LaravelFr\ApiTesting\Tests\Stubs\JsonSerializableMixedResourcesStub;

class AssertArraysTest extends PHPUnit_Framework_TestCase
{
    use AssertArrays;

    public function testAssertArrayStructureEquals()
    {
        $stub = new JsonSerializableMixedResourcesStub;
        $array = $stub->jsonSerialize();

        $this->assertArrayStructureEquals($stub->structure(), $array);
    }

    public function testSeeArrayTypeStructureEquals()
    {
        $stub = new JsonSerializableMixedResourcesStub;
        $array = $stub->jsonSerialize();

        $this->seeArrayTypedStructure($stub->typedStructure(), $array);
    }
}
