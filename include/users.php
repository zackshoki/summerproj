<?php

    function getAllUsers() {
        $users = dbQuery("
            SELECT *
            FROM users
        ")->fetchAll();
        return $users;
    }
    
    function getUser($userId) {
        $user = dbQuery("
            SELECT *
            FROM users
            WHERE userId = $userId
        ")->fetch();
        return $user;
    }