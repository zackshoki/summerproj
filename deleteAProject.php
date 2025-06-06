<?php

include('include/init.php');
$body = file_get_contents('php://input');
deleteProject($body);

