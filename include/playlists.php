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

    $url = 'playlists/'.$playlistId.'/tracks';

    $formattedSongChunks = array_chunk($formmattedSongIds, 100);
    
    foreach($formattedSongChunks as $chunk) {
        $postData = [
            'uris' => $chunk
        ];
        makeSpotifyPostRequest($token, $url, $postData);

    }

    // update description and name 
    $url = 'playlists/'.$playlistId;
    $postData = [
        'name' => $name, 
        'description' => "$runDistance miles, $pace min/mi pace"
    ];
    makeSpotifyPostRequest($token, $url, $postData, true);
}

function clearPlaylist($playlistId) {
    $token = tokenSetup(); 
    $postData = [
        'uris' => []
    ];
    $url = "playlists/$playlistId/tracks";

    $data = makeSpotifyPostRequest($token, $url, $postData, true);
    
    return $data;
}

function getPlaylist($playlistId) {
    return makeSpotifyGetRequest(tokenSetup(), "playlists/". $playlistId, "");
}

function generatePlaylist($playlistId, $songIds, $name, $runDistance, $pace) {
    clearPlaylist($playlistId); 
    updatePlaylist($playlistId, $songIds, $runDistance, $pace, $name); 
}
