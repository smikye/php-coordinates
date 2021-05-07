<?php
namespace DurationScore\ScoreCalculationMethod;

interface ScoreCalculationMethod
{
    /**
     * @param int $minutes
     * @return int
     */
    public function calculateScore(int $minutes): int;
}