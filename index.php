<?php
require_once __DIR__ . '/vendor/autoload.php';

use DurationScore\DurationScoreService;

try{
    $durationScore = DurationScoreService::calculateDurationScore(
        [47.822297, 35.169209],
        [47.822297, 35.169209],
        'googleDistances');
        var_dump($durationScore);
} catch(Exception $e) {
    echo $e->getMessage();
}
