<?php

namespace LaravelFr\ApiTesting\Tests\Stubs;

use JsonSerializable;

class JsonSerializableMixedResourcesStub implements JsonSerializable
{
    public function jsonSerialize()
    {
        return [
            'foo' => 134,
            'foobar' => [
                'foobar_foo' => 'foo',
                'foobar_bar' => 212,
            ],
            'bars'   => [
                ['bar' => true, 'foo' => 134.212],
                ['bar' => false, 'foo' => 134.212],
                ['bar' => false, 'foo' => 134.212],
            ],
            'baz'    => [
                ['foo' => 'bar 0', 'bar' => ['foo' => true, 'bar' => 134]],
                ['foo' => 'bar 1', 'bar' => ['foo' => false, 'bar' => 212]],
            ],
        ];
    }

    public function structure()
    {
        return [
            'foo',
            'baz' => ['*' => ['bar' => ['*'], 'foo']],
            'bars' => ['*' => ['bar', 'foo']],
            'foobar' => ['foobar_foo', 'foobar_bar'],
        ];
    }

    public function typedStructure()
    {
        return [
            'foo' => 'integer',
            'baz' => ['*' => ['bar' => 'array', 'foo' => 'string']],
            'bars' => ['*' => ['bar' => 'boolean', 'foo' => 'float']],
            'foobar' => ['foobar_foo' => 'string', 'foobar_bar' => 'int'],
        ];
    }
}
