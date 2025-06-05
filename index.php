<?php 
    include('include/init.php');
    $allUsers = getAllUsers();
?>

<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width">
        <title>summerproj</title>
        <link rel="stylesheet" href="stylesheets/styles.css">
        <script type="text/javascript" src="scripts/main.js"></script>
    </head>
    <body>
        <?php debugOutput($allUsers); hello world ?>
    </body>
</html>