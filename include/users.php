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
        $profile = makeSpotifyGetRequest($token, 'me', "");
        $spotify_id = $profile['id'];
        
        dbQuery("
            UPDATE users 
            SET spotifyId= :spotifyId, profile= :profile
            WHERE userId= :userId
        ", [
            ':spotifyId' => $spotify_id, 
            ':profile' => json_encode($profile),
            ':userId' => $userId
        ]);
    }
    function getSpotifyProfile($userId) {
        $profile_json = getUser($userId)['profile'];
        return $profile_json;
    }   
    function getStrideLength($userId) { // in meters, further gain accuracy by separating into walking stride length, jog stride length, run stride length, sprint stride length etc. 
        $stride_length = dbQuery("
            SELECT stride_length
            FROM users
            WHERE userId = $userId 
        ")->fetch()['stride_length'];
        return $stride_length;
    }
    function getUserPlaylist($userId) {
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
            UPDATE users SET playlistId= :playlistId WHERE userId= :userId
        ", [
            ':playlistId' => $playlistId, 
            ':userId' => $userId
        ]);
    }
    function setTotalSongs($token, $userId) {
        $total = totalSavedTracks($token);
        dbQuery(" 
            UPDATE users SET total_songs = :total WHERE userId= :userId
        ", [
            ':total' => $total, 
            ':userId' => $userId
        ]);
    }

    function getTotalSongs($userId) {
        $total = dbQuery("
        SELECT total_songs FROM users WHERE userId=$userId
        ")->fetch()['total_songs']; 
        return $total; 
    }