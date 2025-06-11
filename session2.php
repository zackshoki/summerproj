<?php
    include('include/init.php');
    // $_SESSION['userId'] = 2;
    // debugOutput($_SESSION);
    if (isset($_SESSION['user'])) {
    $currentUser = $_SESSION['user'];
    $username = $currentUser['username'];
    $password = $currentUser['password'];
    echo "hello $username, how are you doing today?";
    echo "<br>";
    echo "i know your password, its $password, mwhahahahahahhaha";
    echo "<br>";
    $loggedout='loggedout';
    echo "<a href='session.php?reason=$loggedout'>logout</a>";
    } else {
        echo 'HACKER!!';
    }