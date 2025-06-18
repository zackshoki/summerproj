<?php
global $total;
function spotifyGetRequest($token, $url, $formatted_fields) 
{
    $spotify_curl = curl_init();

    $spotify_curl_options = [
        CURLOPT_URL => $url."?".$formatted_fields,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.$token
        ],
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_RETURNTRANSFER => TRUE

    ];

    curl_setopt_array($spotify_curl, $spotify_curl_options);
    $data_json = curl_exec($spotify_curl);
    $data = json_decode($data_json, true);
    return $data; 
    
}
function totalSavedTracks() {
    global $token;
    global $total;
    $tracksInfo = spotifyGetRequest($token, 'https://api.spotify.com/v1/me/tracks', "limit=1");
    $total = $tracksInfo['total'];
}
function getAllSavedTracks() { // this needs to get all of a user's saved tracks. we can only get 50 per request, and we can access the total amount of tracks through
    global $total, $token;
    $totalTracks = $total;
    $loopNumber = ($totalTracks - ($totalTracks % 50)) / 50;
    $remainderTracks = $totalTracks % 50;
    $trackIds = [];
    for ($i = 0; $i < $loopNumber; $i++) {
        $trackDatas = spotifyGetRequest($token, 'https://api.spotify.com/v1/me/tracks', "limit=50&offset=".($i*50));
        $tracks = $trackDatas['items'];
        foreach ($tracks as $track) {
            array_push($trackIds, $track['track']['id']);
        }
    }
    if ($remainderTracks > 0) {
        $trackDatas = spotifyGetRequest($token, 'https://api.spotify.com/v1/me/tracks', "limit=$remainderTracks&offset=".($totalTracks - ($totalTracks % 50)));
        $tracks = $trackDatas['items'];
        foreach ($tracks as $track) {
          array_push($trackIds, $track['track']['id']);
        }
    }
    return $trackIds;
}
// reccobeats
$reccoURL = 'https://api.reccobeats.com/v1/';

function spotifyIdsToReccoIds($spotify_ids) { // this needs to take in a array of spotify ids and turn them each into recco ids
    global $reccoURL; // currently, this funciton only works with one id, but we need to tweak it to make it work with many
    $curl = curl_init(); 

    $curl_options = [
        CURLOPT_URL => $reccoURL."track?ids=".$spotify_ids,
        CURLOPT_HTTPHEADER => [
            'Accept: application/json'
        ],
        CURLOPT_RETURNTRANSFER => TRUE,
        
    ];
    curl_setopt_array($curl, $curl_options);
    $data_json = curl_exec($curl);
    $data = json_decode($data_json, true); 
    debugOutput($data);
    $reccoId = $data['content'][0]['id'];

    return $reccoId;
}
function fetchTrackData($reccoIds) { // this only works for one rn, but may use a loop to get many
    global $reccoURL;
    $curl = curl_init(); 

    $curl_options = [
        CURLOPT_URL => $reccoURL."track/".$reccoIds."/audio-features",
        CURLOPT_HTTPHEADER => [
            'Accept: application/json'
        ],
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_RETURNTRANSFER => TRUE
    ];
    curl_setopt_array($curl, $curl_options);
    $data_json = curl_exec($curl);

    $data = json_decode($data_json, true);
    debugOutput($data);
    return $data;
}
?>