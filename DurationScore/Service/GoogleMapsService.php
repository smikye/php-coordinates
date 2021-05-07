<?php
namespace DurationScore\Service;

use Exception;

class GoogleMapsService
{
    /**
     * @var array
     */
    private $config;

    /**
     * GoogleMapsService constructor.
     */
    public function __construct()
    {
        $this->config = include __DIR__ . '/../config/google-maps-api.config.inc';
    }

    /**
     * @param array $originCoords
     * @param array $destinationCoords
     * @return int
     * @throws Exception
     */
    public function getDurationInMinutes(array $originCoords, array $destinationCoords): int {
        $data = $this->getDurationAndDuration($originCoords, $destinationCoords);

        if (!isset($data['rows'][0]['elements'][0]['duration']['text'])) {
            throw new Exception("The Duration Does Not Present in Google Response.");
        }

        preg_match_all('!\d+\.*\d*!', $data['rows'][0]['elements'][0]['duration']['text'], $minutes);

        return (int) $minutes[0][0];
    }

    /**
     * @param array $originCoords
     * @param array $destinationCoords
     * @return float
     * @throws Exception
     */
    public function getDistanceInKm(array $originCoords, array $destinationCoords): float {
        $data = $this->getDurationAndDuration($originCoords, $destinationCoords);

        if (!isset($data['rows'][0]['elements'][0]['distance']['text'])) {
            throw new Exception("The Distance Does Not Present in Google Response.");
        }

        preg_match_all('!\d+\.*\d*!', $data['rows'][0]['elements'][0]['distance']['text'], $distance);

        return (float) $distance[0][0];
    }

    /**
     * @param array $originCoords
     * @param array $destinationCoords
     * @return array
     */
    private function getDurationAndDuration(array $originCoords, array $destinationCoords): array {
        $origins = implode(',', $originCoords);
        $destinations = implode(',', $destinationCoords);
        $params = '?origins=' . $origins . '&destinations=' . $destinations . '&key=' . $this->config['apiKey'];
        $url = $this->config['baseUrl'] . $this->config['apiMethods']['distancematrix']['methodUrl']
            . $this->config['apiMethods']['distancematrix']['outputType'] . $params;

        try {
            return $this->sendGetRequest($url);
        } catch (Exception $exception) {
            die("Error: " . $exception->getMessage() . "\n");
        }
    }

    /**
     * @param string $url
     * @return array
     * @throws Exception
     */
    private function sendGetRequest(string $url): array {
        $curl = curl_init();

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
            CURLOPT_RETURNTRANSFER => 1
        ];

        curl_setopt_array($curl, $options);

        $result = curl_exec($curl);

        if(curl_errno($curl)){
            throw new Exception(curl_error($curl));
        }

        curl_close($curl);

        $result  = json_decode($result, true);

        if (isset($result['error_message'])) {
            throw new Exception($result['error_message']);
        }

        return $result;
    }

}