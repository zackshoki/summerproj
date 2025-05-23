<?php
    $randomVal = rand(-100, 100);

    if ($randomVal > 0) {
        $description = "positive";
    } elses if ($randomVal < 0) {
        $description = "negative";
    } else {
        $description = "zero";
    } 

    echo "the random value of today is ".$randomVal." which is ".$description.".";