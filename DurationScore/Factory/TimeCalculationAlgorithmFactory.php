<?php
namespace DurationScore\Factory;

use DurationScore\TimeCalculationAlgorithm\GoogleDistanceAlgorithm;
use DurationScore\TimeCalculationAlgorithm\GoogleTimeAlgorithm;
use DurationScore\TimeCalculationAlgorithm\StraightDistanceAlgorithm;
use DurationScore\TimeCalculationAlgorithm\TimeCalculationAlgorithm;
use Exception;

class TimeCalculationAlgorithmFactory
{
    /**
     * @param string $algorithmId
     * @return TimeCalculationAlgorithm
     * @throws Exception
     */
    public static function getTimeCalculationAlgorithm(string $algorithmId): TimeCalculationAlgorithm
    {
        switch ($algorithmId) {
            case 'straightDistance':
                return new StraightDistanceAlgorithm;
                break;
            case 'googleDistance':
                return new GoogleDistanceAlgorithm;
                break;
            case 'googleTime':
                return new GoogleTimeAlgorithm;
                break;
            default:
                throw new Exception("Unknown Time Calculation Algorithm");
        }
    }
}