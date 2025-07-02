<?php  
    date_default_timezone_set('America/Chicago');
    session_start();
   
    include('connect.php');
    include('common_components.php');
    include('db_query.php');
    include('helper_functions.php');
    include('users.php');
    include('get_access_token.php');
    include('curl_request.php');
    include('songs.php');
    include('store_track_data.php');
    include('conf.php');
    include('playlists.php');
    $state = bin2hex(random_bytes(16 / 2)); // random string 16 digits long