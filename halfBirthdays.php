<h1 style="text-align: left;font-size: 90px;">

<?php

$birthdays = [
    "Alana Joy" => (int)date("U", mktime(7, 7, 7, 7, 20)),
    "Hamida" => (int)date("U", mktime(7, 7, 7, 8, 8)),
    "Isabelle" => (int)date("U", mktime(7, 7, 7, 9, 7)),
    "Zaid" => (int)date("U", mktime(7, 7, 7, 9, 6)),
    "Zack" => (int)date("U", mktime(7, 7, 7, 9, 20)),
];

foreach ($birthdays as $key => $bday) {
   $halfBday = $bday+86400*182.5;
   echo "Name: ".$key." | ";
   echo "Half-Birthday: ".date("F d", $halfBday);
   echo "<br> <br>";
}