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
    <div id="url"></div>
    link: <div id="playlist"></div>
   <script>
    token = "<?php echo $token ?>";
    fetchProfile(token).then((profile) => {
        populateUI(profile);
        createPlaylist(token, profile.id, "ZackCorp Workout Playlist", "this is a test playlist").then((playlist) => {
            document.getElementById("playlist").innerText = playlist.external_urls.spotify;
        }
        )
    });
    
   </script>
</body>

</html>