<?php
    include('include/init.php');
    $token = tokenSetup();
    debugOutput($_REQUEST);
    if (isset($_POST['playlistId'])) { // ajax could be used here.. but is it needed?
        sendPlaylistIdToDB($_POST['playlistId'], 1); // userId is hardcoded for now
        unset($_POST['playlistId']);
    }
    $playlistId = checkIfPlaylistExists(1);
    debugOutput(['playlistId' => $playlistId]);
    $distance = $_POST['run_distance'];
    $pace = $_POST['pace'];
    $minutes = distanceToMinutes($_POST['run_distance'], $_POST['pace']);
    $tempo = paceToTempo($_POST['pace']);
    // $profileId = json_decode(getSpotifyProfile(1), true)['id'];
    $songs = constructPlaylist($tempo - 10, $tempo + 10, $minutes);
 
    generatePlaylist($playlistId, $songs, "zack's run", $distance, $pace);
  
?>

<html> 
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width">
        <title>Playlist</title>
        <link rel="stylesheet" href="stylesheets/styles.css">
        <script type="text/javascript" src="scripts/main.js"></script>
        <script defer>
            const profile = <?php echo getSpotifyProfile(1); ?>;
            const playlistId = "<?php echo $playlistId ?>";
            const songs = <?php echo json_encode($songs, true) ?>;

            
        </script>
    </head>

    <body> 
        <form id="form" action="display_playlist.php" method="post">
            <input type="text" id="playlistId" style="display:none" value="" name="playlistId"/>
            <input type="submit" style="display:none"/> 
        </form>
    </body>
</html>


    