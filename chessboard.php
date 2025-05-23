<html>
<div style="width: 100px;height:1000px;font-size:200px">
<?php
$alternator = 1;
$arrayThruEight = [0, 1, 2, 3, 4, 5, 6, 7];
$eightTimes = $arrayThruEight;
foreach($eightTimes as $nothing) {
    foreach($arrayThruEight as $counter) {
        if ($alternator % 2 == 0) {
        if ($counter % 2 == 0) {
            echo "■";
        } else {
            echo "□";
        }
    } else {
        if ($counter % 2 == 0) {
            echo "□";
        } else {
            echo "■";
        }
    }
    }
    echo "<br>";
    $alternator = $alternator + 1;
}
?>
</div>
</html>

