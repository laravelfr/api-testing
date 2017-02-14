<?php

namespace LaravelFr\ApiTesting;

trait AssertJsonResponse
{
    use AssertArrays;

    /**
     * Assert that the JSON response has exactly the given structure.
     *
     * @param  array $structure
     * @param  array|null $responseData
     *
     * @return $this
     */
    public function seeJsonStructureEquals(array $structure, $responseData = null)
    {
        if (!$responseData) {
            $responseData = $this->decodeResponseJson();
        }

        return $this->assertArrayStructureEquals($structure, $responseData);
    }

    /**
     * Return the json response or a part of it as an array.
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function jsonResponse($key = null)
    {
        $response = $this->decodeResponseJson();

        return $key ? array_get($response, $key) : $response;
    }
}
