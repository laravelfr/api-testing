<?php

namespace LaravelFr\ApiTesting;

trait AssertArrays
{
    abstract public function assertEquals(
        $expected,
        $actual,
        $message = '',
        $delta = 0.0,
        $maxDepth = 10,
        $canonicalize = false,
        $ignoreCase = false
    );

    abstract public function assertInternalType(
        $expected,
        $actual,
        $message = ''
    );

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
            $this->assertEquals($structureFirstLevel, $responseFirstLevel, '', 0.0, 10, true);
        }

        $structureOtherLevels = array_filter($structure, function ($value) {
            return is_array($value);
        });

        foreach ($structureOtherLevels as $key => $childStructure) {
            if ($key === '*') {
                $this->assertInternalType('array', $array);

                foreach ($array as $responseDataItem) {
                    $this->assertArrayStructureEquals($childStructure, $responseDataItem);
                }
            } else {
                $this->assertArrayStructureEquals($childStructure, $array[$key]);
            }
        }

        return $this;
    }
}
