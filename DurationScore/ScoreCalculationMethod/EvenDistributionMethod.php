<?php
namespace DurationScore\ScoreCalculationMethod;

class EvenDistributionMethod implements ScoreCalculationMethod
{
    /**
     * @param int $minutes
     * @return int
     */
    public function calculateScore(int $minutes): int
    {
        if ($minutes >= 30) {
            return 100;
        } elseif ($minutes < 30 && $minutes !== 0) {
            return round($minutes * (100 / 30));
        } else {
            return 0;
        }
    }
}