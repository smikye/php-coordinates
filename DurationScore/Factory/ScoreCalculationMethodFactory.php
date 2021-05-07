<?php
namespace DurationScore\Factory;

use DurationScore\ScoreCalculationMethod\Base2Method;
use DurationScore\ScoreCalculationMethod\EvenDistributionMethod;
use DurationScore\ScoreCalculationMethod\ScoreCalculationMethod;
use Exception;

class ScoreCalculationMethodFactory
{
    /**
     * @param string $methodId
     * @return ScoreCalculationMethod
     * @throws Exception
     */
    public static function getScoreCalculationMethod(string $methodId): ScoreCalculationMethod
    {
        switch ($methodId) {
            case 'evenDistribution':
                return new EvenDistributionMethod;
                break;
            case 'base2':
                return new Base2Method;
                break;
            default:
                throw new Exception("Unknown Score Calculation Method");
        }
    }
}