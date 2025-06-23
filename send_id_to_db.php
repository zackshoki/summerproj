<?php
include('include/init.php');

sendPlaylistIdToDB($_POST['playlistId'], 1); // userId is hardcoded for now but should be changed for logins later
header('Location: index.php');