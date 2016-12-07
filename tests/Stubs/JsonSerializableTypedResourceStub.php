<?php

namespace LaravelFr\ApiTesting\Tests\Stubs;

use JsonSerializable;

class JsonSerializableTypedResourceStub implements JsonSerializable
{
    public function jsonSerialize()
    {
        return json_decode('{
            "foo": "bar",
            "bar": 42,
            "foobar": [
                "foo",
                "bar"
            ],
            "baz": true,
            "nested_foo": {
                "foo": "bar",
                "bar": 42,
                "foobar": [
                    "foo",
                    "bar"
                ],
                "baz": false,
                "double_nested_foo": {
                    "foo": "bar",
                    "bar": 42,
                    "foobar": [
                        "foo",
                        "bar"
                    ],
                    "baz": false
                }
            }
        }');
    }
}
