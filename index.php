<?php
    include('include/init.php');
    $token = tokenSetup();


    
    // saveTracksToDB(); this was commented out to make reloads faster. still havent found a good way to save all your songs to the db at once. 
   
?>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>Sprintify</title>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <script type="text/javascript" src="scripts/main.js"></script>
    <script defer>
        token = "<?php echo $token ?>";
   
        fetchProfile(token).then((profile) => {
            populateUI(profile);
        });
   </script>
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
    
    <form id="userData" action="display_playlist.php" method="GET"> 
        <strong>distance:</strong> <input type="text" id="runtime" name="run_time" value="3"/> miles <br>
        <strong>desired pace:</strong> <input type="text" id="pace" name="pace" value="10"/> min/mi
        <input type="submit" /> 
    </form>
</body>

</html>