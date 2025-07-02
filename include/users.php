<?php

    function getAllUsers() {
        $users = dbQuery("
            SELECT *
            FROM users 
        ")->fetchAll();
        return $users; // must make sure that archived users are not retrieved
    }
    
    // must make sure that archived users are not retrieved
    function getUser($userId) {
        $user = dbQuery("
            SELECT *
            FROM users
            WHERE userId = $userId 
        ")->fetch();
        return $user;
    }
    function setUserSpotifyId($token, $userId) { // takes in my user's id and sends their spotify id & profile to the db
        $profile = spotifyGetRequest($token, 'https://api.spotify.com/v1/me', "");
        $spotify_id = $profile['id'];
        
        dbQuery("
            UPDATE users SET spotifyId='$spotify_id' WHERE userId='$userId'
        ");
        dbQuery("
            UPDATE users SET profile='". json_encode($profile)."' WHERE userId='$userId'
        ");
    }
    function getSpotifyProfile($userId) {
        $profile_json = dbQuery("
            SELECT profile FROM users WHERE userId='$userId'
        ")->fetch()['profile'];

        return $profile_json;
    }   
    function getStrideLength($userId) { // in meters, further gain accuracy by separating into walking stride length, jog stride length, run stride length, sprint stride length etc. 
        $stride_length = dbQuery("
            SELECT stride_length
            FROM users
            WHERE userId = $userId 
        ")->fetch();
        return $stride_length;
    }
    function checkIfPlaylistExists($userId) {
        $playlistId = dbQuery("
            SELECT playlistId FROM users WHERE userId='$userId'
        ")->fetch()['playlistId'] ?? NULL;
        if ($playlistId == NULL) {
            $playlistId = createPlaylist("zack's workout playlist", "this a test playlist");
        }
        return $playlistId;
    }
    function sendPlaylistIdToDB($playlistId, $userId) {
        dbQuery("
            UPDATE users SET playlistId='$playlistId' WHERE userId='$userId'
        ");
    }