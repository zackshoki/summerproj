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
    saveTracksToDB();
    $playlistId = checkIfPlaylistExists(1)['playlistId'];
?>
<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>Sprintify</title>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <script type="text/javascript" src="scripts/main.js"></script>
</head>

<body>
    <div id="avatar"></div>
    <div id="displayName"></div>
    <div id="imgUrl"></div>
    <div id="id"></div>
    <div id="email"></div>
    <div id="uri"></div>
    <div id="url"><?php echo $playlistId; ?></div>
    link: <div id="playlist"></div>
    <form id="form" action="send_id_to_db.php" method="POST">
        <input type="text" id="playlistId" style="display:hidden" value="" name="playlistId"/>
        <input type="submit" style="display:hidden"/> 
    </form>
   <script>
    token = "<?php echo $token ?>";
    playlistId = "<?php echo $playlistId ?>";

    if (playlistId == "NULL") {
        fetchProfile(token).then((profile) => {
        populateUI(profile);
        createPlaylist(token, profile.id, "ZackCorp Workout Playlist", "this is a test playlist").then((playlist) => {
            document.getElementById("playlist").innerText = playlist.external_urls.spotify;
            document.getElementById("playlistId").value = playlist.id
            // document.getElementById("form").requestSubmit(); // store playlist id through form submission to database to check if the playlist exists already, delete the id if the user wants to save the playlist
        }
        )
    }); 
    } else {
        fetchProfile(token).then((profile) => {
        populateUI(profile);
        clearPlaylist(token, playlistId);
        updatePlaylist(token, playlistId, ['2qmmnbJ9JR3f7vofbyje5r', '1G3YgeTpECl3LYqFsUfzs5', '0VU5k3vCrpqDgUygMjiFYj']).then((playlist) => { // songs are hard coded but should be picked later
            document.getElementById("playlist").innerText = playlistId;
            // document.getElementById("form").requestSubmit(); // store playlist id through form submission to database to check if the playlist exists already, delete the id if the user wants to save the playlist
        }
        )
    });
    }
    
    
   </script>
</body>

</html>