<h1 style="text-align: center;font-size: 180px;margin-top: 600px">
<?php
$people = ["Hamida", "Alana Joy", "Isabelle", "Zaid", "Zack", "Eva"];
$index = rand(0, count($people)-1);
echo $people[$index];