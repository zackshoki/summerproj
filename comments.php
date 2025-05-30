<?php

function getComments() {

    $comments = dbQuery(
        '
        SELECT * FROM comments
        '
    )->fetchAll();
    return $comments;
}

function insertComment($userName, $comment) {
    dbQuery("
    INSERT INTO comments(content, name) VALUES (:comment,:userName)
    ", [
    'userName' => $userName,
    'comment' => $comment
]);
}