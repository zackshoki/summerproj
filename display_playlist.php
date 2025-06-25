<?php
    include('include/init.php');
    $token = tokenSetup();
   debugOutput($_REQUEST);
    if (isset($_POST['playlistId'])) { // ajax could be used here.. but is it needed?
        sendPlaylistIdToDB($_POST['playlistId'], 1); // userId is hardcoded for now
        unset($_POST['playlistId']);
    }
    $playlistId = checkIfPlaylistExists(1)['playlistId'];
    $songs = constructPlaylist(90, 100, 30*60);
    
  
?>

<html> 
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width">
        <title>Playlist</title>
        <link rel="stylesheet" href="stylesheets/styles.css">
        <script type="text/javascript" src="scripts/main.js"></script>
        <script defer>
            token = "<?php echo $token ?>";
            playlistId = "<?php echo $playlistId ?>";
            songs = <?php echo json_encode($songs, true) ?>;

            fetchProfile(token).then((profile) => {
                generatePlaylist(token, profile.id, playlistId, songs);
            });
        </script>
    </head>

    <body> 
        <form id="form" action="display_playlist.php" method="post">
            <input type="text" id="playlistId" style="display:none" value="" name="playlistId"/>
            <input type="submit" style="display:none"/> 
        </form>
    </body>
</html>


    