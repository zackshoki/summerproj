<?php
    include('include/init.php');
    tokenSetup();
    // saveTracksToDB(); // this was commented out to make reloads faster. still havent found a good way to save all your songs to the db at once. 
?>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>Sprintify</title>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <script type="text/javascript" src="scripts/main.js"></script>
</head>

<body>
    <div> 
        <h1>Sprintify</h1>
    </div>
    <div id="avatar"></div>
    <div id="displayName"></div>
    <div id="imgUrl"></div>
    <div id="id"></div>
    <div id="email"></div>
    <div id="uri"></div>
    <div id="url"></div>
    
    <form id="userData" action="display_playlist.php" method="POST">
        <strong>distance:</strong> <input type="text" id="runDistance" name="run_distance" value="3"/> miles <br>
        <strong>desired pace:</strong> <input type="text" id="pace" name="pace" value="10"/> min/mi <br> 
        <strong>height (inches):</strong> <input type="text" id="height" name="height" value="73"/> inches <br> 
        <!-- height is not currently used in calculations and stride length is assumed, but later should be modified for stride length to be calculated -->
        <input type="submit" /> 
    </form>

    <script defer>
        const profile = <?php echo getSpotifyProfile(1); /* userID is hardcoded for now */ ?>;
        populateUI(profile);
   </script>
</body>

</html>