<?php

include('include/init.php');
$allUsers = getAllUsers();
if (!isset($_COOKIE['spotify_token'])) {
    if (isset($_REQUEST['code']) && isset($_REQUEST['state'])) {
        $token = requestAccessToken($_REQUEST['code'], $_REQUEST['state']); 
    } else {
        header('Location: login.php'); // work on refresh tokens in the future. 
    }

    
} else {
    $token = $_COOKIE['spotify_token'];
}
?>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>summ3erproj</title>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <script type="text/javascript" src="scripts/main.js"></script>
</head>

<body>
    <?php 
    $spotifySong = spotifyGetRequest($token, 'https://api.spotify.com/v1/me/tracks', "limit=20");
    $spotifyId = $spotifySong['items'][0]['track']['id'];
    // $isrc = 'USAT21500442';
    fetchTrackData(spotifyIdsToReccoIds($spotifyId));

    ?>
    <div id="avatar"></div>
    <div id="displayName"></div>
    <div id="imgUrl"></div>
    <div id="id"></div>
    <div id="email"></div>
    <div id="uri"></div>
    <div id="url"></div>
   <script>
    token = "<?php echo $token ?>";
    fetchProfile(token).then((profile) => {
        thing = profile;
        populateUI(profile);
    });
   </script>
</body>

</html>