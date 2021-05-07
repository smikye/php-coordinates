<?php
namespace DurationScore\TimeCalculationAlgorithm;

class StraightDistanceAlgorithm implements TimeCalculationAlgorithm
{
    /**
     * @param array $homeCoords
     * @param array $workCoords
     * @param int $speed
     * @return int
     */
    public function calculateTime(array $homeCoords, array $workCoords, int $speed = 30): int
    {
        $distance = $this->getDistance($homeCoords, $workCoords);

        return round($distance / $speed * 60);
    }

    /**
     * @param array $homeCoords
     * @param array $workCoords
     * @param float $earthRadius
     * @return float
     */
    private function getDistance(array $homeCoords, array $workCoords, $earthRadius = 6372.797): float
    {
        $pi80 = M_PI / 180;
        $homeCoords[0] *= $pi80;
        $homeCoords[1] *= $pi80;
        $workCoords[0] *= $pi80;
        $workCoords[1] *= $pi80;

        $dlat = $workCoords[0] - $homeCoords[0];
        $dlon = $workCoords[1] - $homeCoords[1];

        $a = sin($dlat / 2) * sin($dlat / 2) + cos($homeCoords[0]) * cos($workCoords[0]) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

}