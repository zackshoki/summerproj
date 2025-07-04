<?php
    include('include/init.php');
    $token = tokenSetup(); 
    $playlistId = getUserPlaylist(1); // userId is hardcoded

    if (!empty($_POST['run_distance']) && !empty($_POST['pace'])) {
        $distance = $_POST['run_distance'];
        $pace = $_POST['pace'];
    } else {
        header('Location: index.php'); // redirect if the distance and pace are not set
    }

    $minutes = distanceToMinutes($_POST['run_distance'], $_POST['pace']);
    $tempo = paceToTempo($_POST['pace']);

    $songs = constructPlaylist($tempo - 10, $tempo + 10, $minutes);
 
    generatePlaylist($playlistId, $songs, "zack's run", $distance, $pace);
    $playlist_json = json_encode(getPlaylist($playlistId)); 
?>

<html> 
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width">
        <title>Playlist</title>
        <link rel="stylesheet" href="stylesheets/styles.css">
        <script type="text/javascript" src="scripts/main.js"></script>
        
    </head>

    <body> 
        <div id="playlistName"></div>
        <div id="playlistImage"></div>
        <div id="songNames"></div> 
        <script>
            const profile = <?php echo getSpotifyProfile(1); // userId is hardcoded ?>;
            const playlist = <?php echo $playlist_json; ?>; 
            const songs = <?php echo json_encode($songs, true) ?>;
            showPlaylist(playlist);
        </script>
    </body>
</html>


    