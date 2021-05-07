<?php
namespace DurationScore\TimeCalculationAlgorithm;

interface TimeCalculationAlgorithm
{
    /**
     * @param array $homeCoords
     * @param array $workCoords
     * @return int
     */
    public function calculateTime(array $homeCoords, array $workCoords): int;
}