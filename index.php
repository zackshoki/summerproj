<?php
include('include/init.php');
$allUsers = getAllUsers();
// if (!isset($_COOKIE['spotify_token'])) {
//     if (isset($_REQUEST['code']) && isset($_REQUEST['state'])) {
        
//         $token = requestAccessToken($_REQUEST['code'], $_REQUEST['state']); 
//     } else {
//         header('Location: login.php'); // work on refresh tokens in the future. 
//     }
    
// } else {
//     $token = $_COOKIE['spotify_token'];
// }
// ?>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>summ3erproj</title>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <script defer type="text/javascript" src="scripts/main.js">
       // populateUI(fetchProfile(</?php echo $token ?>));
       
    </script>
</head>

<body>
    <?php 
    // $data = fetchTrackData(isrctoMBID('USSM11603181'));
    // var_dump( $data);
    ?>
    <div id="avatar"></div>
    <div id="displayName"></div>
    <div id="imgUrl"></div>
    <div id="id"></div>
    <div id="email"></div>
    <div id="uri"></div>
    <div id="url"></div>
</body>

</html>