<?php

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
// reccobeats
$reccoURL = 'https://api.reccobeats.com/v1/';

function spotifyIdsToReccoIds($spotify_ids) { // isrc is a universally identifying code for a specific song recording, mbid is this-api specific idenifying code for the same recording
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