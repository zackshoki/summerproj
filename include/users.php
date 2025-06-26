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
    }