<?php

namespace LaravelFr\ApiTesting;

use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;

trait AssertJsonResponse
{
    use AssertArrays, MakesHttpRequests;

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

    /**
     * Assert that the JSON response has a given typed structure.
     *
     * @param  array|null  $structure
     * @param  array|null  $responseData
     * @return $this
     */
    public function seeJsonTypedStructure(array $structure = null, $responseData = null)
    {
        if (is_null($structure)) {
            return $this->seeJsonStructure($structure);
        }

        if (!$responseData) {
            $responseData = json_decode($this->response->getContent(), true);
        }

        foreach ($structure as $key => $type) {
            if (is_array($type) && $key === '*') {
                $this->assertInternalType('array', $responseData);

                foreach ($responseData as $responseDataItem) {
                    $this->seeJsonTypedStructure($structure['*'], $responseDataItem);
                }
            } elseif (is_array($type) && array_key_exists($key, $structure)) {
                if (is_array($structure[$key])) {
                    $this->seeJsonTypedStructure($structure[$key], $responseData[$key]);
                }
            } else {
                $this->assertInternalType($type, $responseData[$key]);
            }
        }

        return $this;
    }
}
