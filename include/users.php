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

    function checkIfPlaylistExists($userId) {
        $playlistId = dbQuery("
            SELECT playlistId FROM users WHERE userId='$userId'
        ")->fetch();
        if ($playlistId == NULL) {
            return NULL;
        } else {
            return $playlistId;
        }
    }
    function sendPlaylistIdToDB($playlistId, $userId) {
        dbQuery("
            UPDATE users SET playlistId='$playlistId' WHERE userId='$userId'
        ");


    function setTotalSongs($userId) {
        $total = totalSavedTracks();
        dbQuery(" 
        UPDATE users SET total_songs ='$total' WHERE userId=$userId
        ");
    }

    function getTotalSongs($userId) {
        $total = dbQuery("
        SELECT total_songs FROM users WHERE userId=$userId
        ")->fetch()['total_songs']; 
        return $total; 

    }