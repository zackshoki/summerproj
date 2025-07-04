<?php

function tokenSetup() {

    if (!isset($_COOKIE['spotify_token'])) { 
        if (isset($_REQUEST['code']) && isset($_REQUEST['state'])) {
            $token = requestAccessToken($_REQUEST['code'], $_REQUEST['state']); 
            setUserSpotifyId($token, 1);  // userId is hard coded for now
            setTotalSongs($token, 1); // userId is hardcoded, songs are only set like once an hour or once every time you log in
        } else {
            header('Location: login.php'); // work on refresh tokens in the future. 
        }   
    } else {
        $token = $_COOKIE['spotify_token'];
    }
    return $token;
}