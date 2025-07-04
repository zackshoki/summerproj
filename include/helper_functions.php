<?php

    function debugOutput($array) {
        $clean = htmlspecialchars(print_r($array, true ));
        echo "<pre>".$clean."</pre>";
    }
    function paceToTempo($pace) { // running cadence calculations... potentiallly have an option for runners to either enter their height, enter their steps per minute, or link their strava for more accurate calculations
        $strideLength = getStrideLength(1); // userId is hard coded for now. stride length is in meters
        $tempo = 1609.34/(floatval($pace)*floatval($strideLength)); // accuracy could definitely be improved
        return $tempo;
    }
    
    function distanceToMinutes($distance, $pace) { // distance is in miles, pace is in minutes per mile
        $minutes = floatval($distance) * floatval($pace);
        return $minutes;
    }