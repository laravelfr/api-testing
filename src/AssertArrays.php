<?php

namespace LaravelFr\ApiTesting;

use PHPUnit\Framework\Assert as PHPUnit;

trait AssertArrays
{
    /**
     * Assert that the given array has exactly the given structure.
     *
     * @param  array $structure
     * @param  array $array
     *
     * @return $this
     */
    public function assertArrayStructureEquals(array $structure, array $array)
    {
        $structureFirstLevel = array_map(function ($value, $key) {
            return is_array($value) ? $key : $value;
        }, $structure, array_keys($structure));

        $responseFirstLevel = array_keys($array);

        if ($structureFirstLevel !== ['*']) {
            PHPUnit::assertEquals($structureFirstLevel, $responseFirstLevel, '', 0.0, 10, true);
        }

        $structureOtherLevels = array_filter($structure, function ($value) {
            return is_array($value);
        });

        foreach ($structureOtherLevels as $key => $childStructure) {
            if ($key === '*') {
                PHPUnit::assertInternalType('array', $array);

                foreach ($array as $responseDataItem) {
                    $this->assertArrayStructureEquals($childStructure, $responseDataItem);
                }
            } else {
                $this->assertArrayStructureEquals($childStructure, $array[$key]);
            }
        }

        return $this;
    }

    /**
     * Assert that the array has a given typed structure.
     *
     * @param  array|null $structure
     * @param  array $array
     *
     * @return $this
     */
    public function seeArrayTypedStructure(array $structure, array $array)
    {
        foreach ($structure as $key => $type) {
            if (is_array($type) && $key === '*') {
                PHPUnit::assertInternalType('array', $array);

                foreach ($array as $arrayItem) {
                    $this->seeArrayTypedStructure($structure['*'], $arrayItem);
                }
            } elseif (is_array($type) && isset($structure[$key])) {
                if (is_array($structure[$key])) {
                    $this->seeArrayTypedStructure($structure[$key], $array[$key]);
                }
            } else {
                PHPUnit::assertInternalType($type, $array[$key]);
            }
        }

        return $this;
    }
}
