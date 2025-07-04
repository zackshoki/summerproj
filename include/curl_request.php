<?php


function makeSpotifyGetRequest($token, $url, $formatted_fields) 
{
    $spotify_curl = curl_init();
    $spotifyURL = "https://api.spotify.com/v1/";
    $spotify_curl_options = [
        CURLOPT_URL => $spotifyURL.$url."?".$formatted_fields,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.$token
        ],
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_RETURNTRANSFER => TRUE

    ];

    $data = runCurlRequest($spotify_curl, $spotify_curl_options);
    return $data; 
    
}

function makeSpotifyPostRequest($token, $url, $postData, $putRequest = false) {
    $spotify_curl = curl_init();
    $spotifyURL = "https://api.spotify.com/v1/";

    $spotify_curl_options = [
        CURLOPT_URL => $spotifyURL . $url,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.$token,
            'Content-Type: application/json'
        ],
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_POSTFIELDS => json_encode($postData)
    ];
    if ($putRequest == true) {
        $spotify_curl_options[CURLOPT_CUSTOMREQUEST] = "PUT";
    }

    curl_setopt_array($spotify_curl, $spotify_curl_options);
    $data_json = curl_exec($spotify_curl);
    $data = json_decode($data_json, true);
    
    return $data; 
}

function totalSavedTracks($token) {
    $tracksInfo = makeSpotifyGetRequest($token, 'me/tracks', "limit=1");
    return $tracksInfo['total'];
}

function getAllSavedTracks() { 
    global $token;
    $totalTracks = getTotalSongs(1); // userId is hardcoded
    $loopNumber = ($totalTracks - ($totalTracks % 50)) / 50;
    $remainderTracks = $totalTracks % 50;
    
    $trackIds = [];
    for ($i = 0; $i < $loopNumber; $i++) {
        $trackDatas = makeSpotifyGetRequest($token, 'me/tracks', "limit=50&offset=".($i*50));
        $tracks = $trackDatas['items'];
        foreach ($tracks as $track) {
            array_push($trackIds, $track['track']['id']);
        }
    }
    if ($remainderTracks > 0) {
        $trackDatas = makeSpotifyGetRequest($token, 'me/tracks', "limit=$remainderTracks&offset=".($totalTracks - ($totalTracks % 50)));
        $tracks = $trackDatas['items'];
        foreach ($tracks as $track) {
          array_push($trackIds, $track['track']['id']);
        }
    }
    return $trackIds;
}

// reccobeats
$reccoURL = 'https://api.reccobeats.com/v1/';
function runCurlRequest($curl, $curl_options) {
    curl_setopt_array($curl, $curl_options);
    $data_json = curl_exec($curl);
    $data = json_decode($data_json, true);
    return $data;
}
function spotifyIdsToReccoData($spotifyIds) { 
    global $reccoURL;
    $curl = curl_init(); 
    $reccoIds = [];

    foreach (array_chunk($spotifyIds, 40) as $chunk) {
        $curl_options = [
            CURLOPT_URL => $reccoURL."track?ids=".implode(",", $chunk),
            CURLOPT_HTTPHEADER => [
                'Accept: application/json'
            ],
            CURLOPT_RETURNTRANSFER => TRUE,
        ];
        $data = runCurlRequest($curl, $curl_options);
        foreach ($data['content'] as $track) {
            $songId = $track['id'];
            $reccoIds[$songId] = $track;
        }
    }

    return $reccoIds;
}

function analyzeTracks($tracks) { // takes an array of track metadata like the one returned from spotifyIdsToReccoData and gets the audio analysis from each one 
    global $reccoURL; 
    $curl = curl_init(); 
    $tracksFeatures = [];
    foreach ($tracks as $track) {
    
        $curl_options = [
            CURLOPT_URL => $reccoURL."track/".$track['id']."/audio-features",
            CURLOPT_HTTPHEADER => [
                'Accept: application/json'
            ],
            CURLOPT_RETURNTRANSFER => TRUE,
            
        ];
        $data = runCurlRequest($curl, $curl_options);

        array_push($tracksFeatures, $data);
    }
    return $tracksFeatures;
}
