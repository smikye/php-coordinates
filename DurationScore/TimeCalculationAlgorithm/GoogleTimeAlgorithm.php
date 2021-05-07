<?php
namespace DurationScore\TimeCalculationAlgorithm;

use DurationScore\Service\GoogleMapsService;
use Exception;

class GoogleTimeAlgorithm implements TimeCalculationAlgorithm
{
    /**
     * @param array $homeCoords
     * @param array $workCoords
     * @return int
     */
    public function calculateTime(array $homeCoords, array $workCoords): int
    {
        return $this->getTime($homeCoords, $workCoords);
    }

    /**
     * @param array $homeCoords
     * @param array $workCoords
     * @return int
     */
    private function getTime(array $homeCoords, array $workCoords): int {
        $googleMapsService = new GoogleMapsService();

        try {
            return $googleMapsService->getDurationInMinutes($homeCoords, $workCoords);
        } catch (Exception $exception) {
            die("Error: " . $exception->getMessage() . "\n");
        }

    }

}