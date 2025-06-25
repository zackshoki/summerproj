<?php
    include('include/init.php');
    $token = tokenSetup();
   
    if (isset($_GET['playlistId'])) { // ajax could be used here.. but is it needed?
        sendPlaylistIdToDB($_GET['playlistId'], 1); // userId is hardcoded for now
        unset($_GET['playlistId']);
    }
    $playlistId = checkIfPlaylistExists(1)['playlistId'];

?>

<html> 
    <head>
        <script type="text/javascript" src="scripts/main.js"></script>
        <script defer>
            token = "<?php echo $token ?>";
            playlistId = "<?php echo $playlistId ?>";

            fetchProfile(token).then((profile) => {
                generatePlaylist(token, profile.id, playlistId);
            })
        </script>
    </head>

    <body> 
        <form id="form" action="index.php" method="GET">
            <input type="text" id="playlistId" style="display:none" value="" name="playlistId"/>
            <input type="submit" style="display:none"/> 
        </form>
    </body>
</html>


    