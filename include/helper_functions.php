

<?php

function debugOutput($array){

$clean = htmlspecialchars( print_r( $array, true ) ); // look up htmlspecial chars and print_r

echo"<pre>".$clean."</pre>";

}