<?php

function createPlaylist($name, $description) {
    $token = tokenSetup();
    $postData = [
        "name" => $name,
        "description" => $description,
        "public" => false
    ];

    $user = getUser(1);
    $userId = $user['userId'];

    $playlist = makeSpotifyPostRequest($token, "users/317xhhb2qgw32elx7ebxeltoadb4/playlists", $postData);
    sendPlaylistIdToDB($playlist['id'], $userId);
    return $playlist['id'];
}

function updatePlaylist($playlistId, $songIds) {
    $token = tokenSetup();
    $formmattedSongIds =  [];
    foreach ($songIds as $songId) {
        $formmattedSongIds[] = "spotify:track:".$songId;
    }

    $url = 'https://api.spotify.com/v1/playlists/'.$playlistId.'/tracks?uris='.implode(",", $formmattedSongIds);
   
    $spotify_curl = curl_init();

    $spotify_curl_options = [
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.$token
        ],
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_RETURNTRANSFER => TRUE

    ];

    curl_setopt_array($spotify_curl, $spotify_curl_options);
    $data_json = curl_exec($spotify_curl);
    $data = json_decode($data_json, true);
    return $data;    
}

function clearPlaylist($playlistId) {
    // to-do
}

function getPlaylist($playlistId) {
    $spotifyURL = 'https://api.spotify.com/v1/';
    return spotifyGetRequest(tokenSetup(), $spotifyURL."playlists/". $playlistId, "");
}