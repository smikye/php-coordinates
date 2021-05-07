<?php
namespace DurationScore\TimeCalculationAlgorithm;

use DurationScore\Service\GoogleMapsService;
use Exception;

class GoogleDistanceAlgorithm implements TimeCalculationAlgorithm
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
     * @return float
     */
    private function getDistance(array $homeCoords, array $workCoords): float
    {
        $googleMapsService = new GoogleMapsService();

        try {
            return $googleMapsService->getDistanceInKm($homeCoords, $workCoords);
        } catch (Exception $exception) {
            die("Error: " . $exception->getMessage() . "\n");
        }
    }

}