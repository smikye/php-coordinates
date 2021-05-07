<?php
namespace DurationScore;

use DurationScore\Factory\TimeCalculationAlgorithmFactory;
use DurationScore\Factory\ScoreCalculationMethodFactory;
use Exception;

class DurationScoreService
{
    /**
     * @param array $homeCoords
     * @param array $workCoords
     * @param string|null $timeCalcAlgorithmId
     * @param string|null $scoreCalcMethodId
     * @return int
     * @throws Exception
     */
    public static function calculateDurationScore(
        array $homeCoords,
        array $workCoords,
        string $timeCalcAlgorithmId = 'straightDistance',
        string $scoreCalcMethodId = null
    ): int {
        if (empty($homeCoords) || count($homeCoords) !== 2 ||
        !is_numeric($homeCoords[0]) || !is_numeric($homeCoords[1])) {
            throw new Exception("Home Coordinates Are Not Valid.");
        }

        if (empty($workCoords) || count($workCoords) !== 2 ||
            !is_numeric($workCoords[0]) || !is_numeric($workCoords[1])) {
            throw new Exception("Work Coordinates Are Not Valid.");
        }

        try {
            $timeCalcAlgorithm = TimeCalculationAlgorithmFactory::getTimeCalculationAlgorithm($timeCalcAlgorithmId);
        } catch (Exception $exception) {
            die("Error :" . $exception->getMessage() . "\n");
        }

        $time = $timeCalcAlgorithm->calculateTime($homeCoords, $workCoords);

        if(!$scoreCalcMethodId) {
            return $time;
        }

        try {
            $scoreCalcMethod = ScoreCalculationMethodFactory::getScoreCalculationMethod($scoreCalcMethodId);
        } catch (Exception $exception) {
            die("Error :" . $exception->getMessage() . "\n");
        }

        return $scoreCalcMethod->calculateScore($time);
    }

}