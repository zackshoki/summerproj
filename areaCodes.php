<h1 style="text-align: center;font-size: 180px;margin-top: 600px">

<?php

// $prompt = readline('what is your phone number? '); this was an attempt at adding res

$codesToMaps = [
    '573' => 'Jefferson City',
    '314' => 'St. Louis',
    '404' => 'Atlanta',
];

$givenPhone = '5736442459'; // change to a variable that html can pass to

$givenCode = substr($givenPhone, 0, 3);

echo $codesToMaps[$givenCode];
echo "</h1>";
?>
