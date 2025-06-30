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

function updatePlaylist($playlistId, $songIds, $runDistance, $pace, $name = "default workout playlist") {
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

    $url = 'https://api.spotify.com/v1/playlists/'.$playlistId;
    $spotify_curl = curl_init();
    $postData = json_encode([
        'name' => $name, 
        'description' => "$runDistance miles, $pace min/mi pace"
    ]);
    $spotify_curl_options = [
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.$token
        ],
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => $postData

    ];
    curl_setopt_array($spotify_curl, $spotify_curl_options);
    curl_exec($spotify_curl);

    return $data;    
}

function clearPlaylist($playlistId) {
    $token = tokenSetup(); 

    $playlist = getPlaylist($playlistId); 
    
    $songURIs =  [];
    foreach ($playlist['tracks']['items'] as $item) {
        $songURIs[]['uri'] = $item['track']['uri'];
    }

    $json = json_encode($songURIs);

    $postData = json_encode([
        'tracks' => $json
    ]);

    if ($songURIs != []) {
        $spotify_curl = curl_init();
        $url = "https://api.spotify.com/v1/playlists/$playlistId/tracks";
    
        $spotify_curl_options = [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer '.$token,
                'Content-Type: application/json'
            ],
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_POSTFIELDS => $postData
        ];
    
        curl_setopt_array($spotify_curl, $spotify_curl_options);
        $data_json = curl_exec($spotify_curl);
        $data = json_decode($data_json, true);
        
        return $data;
    }
    // to-do
}

function getPlaylist($playlistId) {
    $spotifyURL = 'https://api.spotify.com/v1/';
    return spotifyGetRequest(tokenSetup(), $spotifyURL."playlists/". $playlistId, "");
}

function generatePlaylist($playlistId, $songIds, $name, $runDistance, $pace) {
        clearPlaylist($playlistId); 
        updatePlaylist($playlistId, $songIds, $runDistance, $pace, $name); // add a description and name updator
}