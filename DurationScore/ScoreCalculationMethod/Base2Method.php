<?php
namespace DurationScore\ScoreCalculationMethod;

class Base2Method implements ScoreCalculationMethod
{
    public function calculateScore(int $minutes): int
    {
        if ($minutes >=1 ) {
            return base_convert($minutes, 10, 2);
        } else {
            return 0;
        }
    }

}