<?php
    include('include/init.php');

    if (!isset($_COOKIE['spotify_token'])) { 
        if (isset($_REQUEST['code']) && isset($_REQUEST['state'])) {
            $token = requestAccessToken($_REQUEST['code'], $_REQUEST['state']); 
        } else {
            header('Location: login.php'); // work on refresh tokens in the future. 
        }   
    } else {
        $token = $_COOKIE['spotify_token'];
    }

    if (isset($_POST['playlistId'])) { // ajax could be used here.. but is it needed?
        sendPlaylistIdToDB($_POST['playlistId'], 1); // userId is hardcoded for now
        unset($_POST['playlistId']);
    }
    // saveTracksToDB(); this was commented out to make reloads faster. still havent found a good way to save all your songs to the db at once. 
    $playlistId = checkIfPlaylistExists(1)['playlistId'];
?>
<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>Sprintify</title>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <script type="text/javascript" src="scripts/main.js"></script>
    <script defer>
        token = "<?php echo $token ?>";
        playlistId = "<?php echo $playlistId ?>";
   </script>
    <script defer>
        generatePlaylist(token, playlistId);
   </script>
</head>

<body>
    <div id="avatar"></div>
    <div id="displayName"></div>
    <div id="imgUrl"></div>
    <div id="id"></div>
    <div id="email"></div>
    <div id="uri"></div>
    <div id="url"></div>
    <form id="form" action="index.php" method="POST">
        <input type="text" id="playlistId" style="display:none" value="" name="playlistId"/>
        <input type="submit" style="display:none"/> 
    </form>
</body>

</html>