<?php
     include('include/init.php');
     if ($_REQUEST['reason'] = "loggedout") {
        $_SESSION = [];
    }
    debugOutput($_SESSION);
    debugOutput($_REQUEST); 
    
    if (isset($_REQUEST['email']) && !empty($_REQUEST['email'])) {
        if (isset($_REQUEST['password']) && !empty($_REQUEST['password'])) {
            $user = validateUser($_REQUEST['email'], $_REQUEST['password']);
            debugOutput($user);
            if (!empty($user) && $user['userId']) {
                $_SESSION['user'] = $user;
                header("Location: session2.php");
            } else {
                echo 'user not found';
            }


        } else {
            echo "no password? :(";
        }
    } else {
        echo "email??";
    }
?>

<form action="" method="post"> 
    email:<input id="emailField" type='text' name ="email">
    password: <input id="passwordField" type='text' name ="password">
    <input type="submit" value="login">
</form>