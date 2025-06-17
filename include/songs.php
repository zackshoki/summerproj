<?php 

function getAllSongs() {
    $songs = dbQuery("
            SELECT *
            FROM users 
        ")->fetchAll();
        return $songs; 
}

function getUsersSongs() { // fill in to get all of a user's songs
    
}