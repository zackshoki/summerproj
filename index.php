<?php
include('include/init.php');
$allUsers = getAllUsers();
?>

<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width">
    <title>summ3erproj</title>
    <link rel="stylesheet" href="stylesheets/styles.css">
    <script defer type="text/javascript" src="scripts/main.js"></script>
</head>

<body>
    <div id="thing">
        <h1>
            <?php
            // $token = getToken();
            // $json_data = spotifyCurlRequest($token, "https://api.spotify.com/v1/artists/6vWDO969PvNqNYHIOW5v0m?si=UQO5ex8yS-WnjRHjV3R9Aw");
            // $data = json_decode($json_data, TRUE);
            // echo $data['name'];

            requestUserAuthorization();
            ?>
        </h1>
    </div>
</body>

</html>