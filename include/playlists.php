<?php

function createPlaylist($name, $description) {
    $token = tokenSetup();
    $postData = [
        "name" => $name,
        "description" => $description,
        "public" => false
    ];

    $user = getUser(1); // userId is hardcoded
    $userId = $user['userId'];

    $playlist = makeSpotifyPostRequest($token, "users/317xhhb2qgw32elx7ebxeltoadb4/playlists", $postData);
    sendPlaylistIdToDB($playlist['id'], $userId);
    return $playlist['id'];
}

function updatePlaylist($playlistId, $songIds, $runDistance, $pace, $name = "default workout playlist") {
    $token = tokenSetup();
    $formmattedSongIds =  [];
    foreach ($songIds as $songId) {
        $formmattedSongIds[] = "spotify:track:".$songId;
    }

    $url = 'https://api.spotify.com/v1/playlists/'.$playlistId.'/tracks';

    $formattedSongChunks = array_chunk($formmattedSongIds, 100);
   
    $spotify_curl = curl_init();
    
    $spotify_curl_options = [
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.$token,
            'Content-Type: application/json'
        ],
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_RETURNTRANSFER => TRUE,
    ];

    foreach($formattedSongChunks as $chunk) {
        $postData = json_encode([
            'uris' => $chunk
        ]);
        $spotify_curl_options[CURLOPT_POSTFIELDS] = $postData;
        curl_setopt_array($spotify_curl, $spotify_curl_options);
        curl_exec($spotify_curl);
    }

    // update description and name 
    $url = 'https://api.spotify.com/v1/playlists/'.$playlistId;
    $postData = json_encode([
        'name' => $name, 
        'description' => "$runDistance miles, $pace min/mi pace"
    ]);
    $spotify_curl_options = [
        CURLOPT_URL => $url,
        CURLOPT_POSTFIELDS => $postData

    ];
    curl_setopt_array($spotify_curl, $spotify_curl_options);
    curl_exec($spotify_curl);
}

function clearPlaylist($playlistId) {
    $token = tokenSetup(); 
    $postData = json_encode([
        'uris' => []
    ]);

    $spotify_curl = curl_init();
    $url = "https://api.spotify.com/v1/playlists/$playlistId/tracks";

    $spotify_curl_options = [
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.$token,
            'Content-Type: application/json'
        ],
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_POSTFIELDS => $postData
    ];

    curl_setopt_array($spotify_curl, $spotify_curl_options);
    $data_json = curl_exec($spotify_curl);
    $data = json_decode($data_json, true);
    
    return $data;
}

function getPlaylist($playlistId) {
    $spotifyURL = 'https://api.spotify.com/v1/';
    return spotifyGetRequest(tokenSetup(), $spotifyURL."playlists/". $playlistId, "");
}

function generatePlaylist($playlistId, $songIds, $name, $runDistance, $pace) {
    clearPlaylist($playlistId); 
    updatePlaylist($playlistId, $songIds, $runDistance, $pace, $name); 
}
