<?php

namespace LaravelFr\ApiTesting;

use Illuminate\Foundation\Testing\TestResponse;

trait AssertJsonResponse
{
    use AssertArrays;

    public function __construct()
    {
        if (class_exists(TestResponse::class)) {
            $this->addJsonResponseMacros();
        }
    }

    /**
     * Add the functions to the TestResponse objects.
     */
    public function addJsonResponseMacros()
    {
        $trait = $this;

        TestResponse::macro('assertJsonStructureEquals', function ($structure) use ($trait) {
            return $trait->assertJsonStructureEquals($structure, $this->decodeResponseJson());
        });

        TestResponse::macro('seeJsonTypedStructure', function ($structure) use ($trait) {
            return $trait->seeJsonTypedStructure($structure, $this->decodeResponseJson());
        });

        TestResponse::macro('jsonResponse', function ($key = null) use ($trait) {
            return $trait->jsonResponse($key, $this->decodeResponseJson());
        });
    }

    /**
     * Assert that the JSON response has exactly the given structure.
     *
     * @param  array $structure
     * @param  array|null $responseData
     *
     * @return $this
     */
    public function assertJsonStructureEquals($structure, $responseData = null)
    {
        if (!$responseData) {
            $responseData = $this->decodeResponseJson();
        }

        return $this->assertArrayStructureEquals($structure, $responseData);
    }

    /**
     * Assert that the JSON response has a given typed structure.
     *
     * @param  array $structure
     * @param  array|null $responseData
     * @return $this
     */
    public function seeJsonTypedStructure($structure, $responseData = null)
    {
        if (!$responseData) {
            $responseData = $this->decodeResponseJson();
        }

        return $this->seeArrayTypedStructure($structure, $responseData);
    }

    /**
     * Return the json response or a part of it as an array.
     *
     * @param  string $key
     * @param  array|null $responseData
     *
     * @return mixed
     */
    public function jsonResponse($key = null, $responseData = null)
    {
        if (!$responseData) {
            $responseData = $this->decodeResponseJson();
        }

        return array_get($responseData, $key);
    }
}
